<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function send()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');
        $message = 'Halo dari Laravel! 🚀';

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = Http::get($url, [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);

        if ($response->successful()) {
            return 'Pesan berhasil dikirim ke Telegram!';
        }

        return 'Gagal mengirim pesan!';
    }
}
