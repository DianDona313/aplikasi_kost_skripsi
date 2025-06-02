<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\User;
use App\Services\FonnteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }

    public function send()
    {
        try {
            $penyewas = Penyewa::all();
            $results = [];
            $successCount = 0;
            $failCount = 0;

            foreach ($penyewas as $penyewa) {
                $to = $penyewa->nohp;
                $message = $this->buildReminderMessage($penyewa);
                try {
                    $response = $this->fonnte->sendMessage($to, $message);
                    
                    if (isset($response['status']) && $response['status'] === true) {
                        $successCount++;
                        $results[] = [
                            'user_id' => $penyewa->id,
                            'phone' => $to,
                            'status' => 'success',
                            'response' => $response
                        ];
                    } else {
                        $failCount++;
                        $results[] = [
                            'user_id' => $penyewa->id,
                            'phone' => $to,
                            'status' => 'failed',
                            'error' => $response['reason'] ?? 'Unknown error',
                            'response' => $response
                        ];
                        
                        Log::error('Failed to send message', [
                            'user_id' => $penyewa->id,
                            'phone' => $to,
                            'response' => $response
                        ]);
                    }
                } catch (\Exception $e) {
                    $failCount++;
                    $results[] = [
                        'user_id' => $penyewa->id,
                        'phone' => $to,
                        'status' => 'error',
                        'error' => $e->getMessage()
                    ];
                    
                    Log::error('Exception while sending message', [
                        'user_id' => $penyewa->id,
                        'phone' => $to,
                        'error' => $e->getMessage()
                    ]);
                }

                // Add delay between messages to avoid rate limiting
                sleep(1);
            }

            return response()->json([
                'success' => true,
                'message' => "Messages processed: {$successCount} successful, {$failCount} failed",
                'summary' => [
                    'total' => count($penyewas),
                    'success' => $successCount,
                    'failed' => $failCount
                ],
                'details' => $results
            ]);

        } catch (\Exception $e) {
            Log::error('Error in send method', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing messages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function buildReminderMessage($penyewa)
    {
        return "🏠 *Pengingat Tagihan Kost*\n\n" .
               "Halo {$penyewa->nama},\n\n" .
               "Kami dari {$penyewa->nama_kost} ingin mengingatkan bahwa tagihan kost Anda:\n\n" .
               "📋 *Detail Tagihan:*\n" .
               "• Nama Kamar: {$penyewa->nama_kamar}\n" .
               "• Jumlah Tagihan: Rp " . number_format($penyewa->jumlah_tagihan, 0, ',', '.') . "\n" .
               "• Tenggat Pembayaran: " . date('d/m/Y', strtotime($penyewa->tanggal_tenggat)) . "\n\n" .
               "⏰ Mohon dapat segera melakukan pembayaran sebelum tanggal tersebut.\n\n" .
               "✅ Jika sudah melakukan pembayaran, mohon abaikan pesan ini.\n\n" .
               "Terima kasih 🙏";
    }

    public function checkDeviceStatus()
    {
        try {
            $status = $this->fonnte->getDeviceStatus();
            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}