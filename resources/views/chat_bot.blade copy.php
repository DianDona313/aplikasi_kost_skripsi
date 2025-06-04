<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kost Assistant - Chat Cerdas</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome untuk ikon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #57A438 0%, #F09F38 100%);
      --secondary-gradient: linear-gradient(135deg, #57A438 0%, #F09F38 100%);
      --success-gradient: linear-gradient(135deg, #57A438 0%, #F09F38 100%);
      --card-shadow: 0 10px 40px rgba(0,0,0,0.1);
      --hover-shadow: 0 15px 50px rgba(0,0,0,0.15);
      --border-radius: 16px;
      --animation-speed: 0.3s;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #57A438 0%, #F09F38 50%, #57A438 100%);
      min-height: 100vh;
      margin: 0;
      padding: 20px;
      background-attachment: fixed;
    }

    .main-container {
      width: 100%;
      max-width: 900px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header {
      background: var(--primary-gradient);
      padding: 25px 30px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    .header h1 {
      margin: 0;
      font-size: 2.2rem;
      font-weight: 700;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
      position: relative;
      z-index: 1;
    }

    .header p {
      margin: 8px 0 0 0;
      opacity: 0.9;
      font-size: 1.1rem;
      font-weight: 300;
      position: relative;
      z-index: 1;
    }

    .chat-content {
      padding: 30px;
    }

    .faq-section {
      margin-bottom: 30px;
    }

    .faq-title {
      color: #333;
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .faq-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 12px;
      margin-bottom: 20px;
    }

    .faq-question {
      background: linear-gradient(135deg, #f8f9ff 0%, #e6f3ff 100%);
      border: 2px solid transparent;
      border-radius: 12px;
      padding: 15px 18px;
      cursor: pointer;
      transition: all var(--animation-speed) ease;
      font-weight: 500;
      color: #333;
      position: relative;
      overflow: hidden;
    }

    .faq-question::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
      transition: left 0.6s;
    }

    .faq-question:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(87, 164, 56, 0.15);
      border-color: rgba(87, 164, 56, 0.3);
    }

    .faq-question:hover::before {
      left: 100%;
    }

    .faq-question:active {
      transform: translateY(0);
    }

    .chat-container {
      background: #f8f9fa;
      border-radius: 12px;
      height: 450px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      border: 1px solid #e9ecef;
      margin-bottom: 20px;
    }

    .chat-header {
      background: var(--success-gradient);
      color: white;
      padding: 15px 20px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .chat-messages {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .message {
      max-width: 75%;
      padding: 12px 18px;
      border-radius: 18px;
      font-size: 0.95rem;
      line-height: 1.4;
      position: relative;
      animation: messageSlide 0.4s ease-out;
    }

    @keyframes messageSlide {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .message.user {
      background: var(--primary-gradient);
      color: white;
      align-self: flex-end;
      border-bottom-right-radius: 6px;
      box-shadow: 0 4px 15px rgba(87, 164, 56, 0.3);
    }

    .message.bot {
      background: white;
      color: #333;
      align-self: flex-start;
      border-bottom-left-radius: 6px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: 1px solid #e9ecef;
    }

    .input-container {
      display: flex;
      gap: 12px;
      align-items: flex-end;
    }

    .input-wrapper {
      flex: 1;
      position: relative;
    }

    #question-input {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid #e9ecef;
      border-radius: 25px;
      font-size: 1rem;
      transition: all var(--animation-speed) ease;
      background: white;
      resize: none;
      font-family: inherit;
    }

    #question-input:focus {
      outline: none;
      border-color: #57A438;
      box-shadow: 0 0 0 3px rgba(87, 164, 56, 0.1);
    }

    .send-button {
      width: 55px;
      height: 55px;
      border: none;
      border-radius: 50%;
      background: var(--primary-gradient);
      color: white;
      cursor: pointer;
      transition: all var(--animation-speed) ease;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      box-shadow: 0 4px 15px rgba(87, 164, 56, 0.3);
    }

    .send-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(87, 164, 56, 0.4);
    }

    .send-button:active {
      transform: translateY(0);
    }

    .typing-indicator {
      display: none;
      align-self: flex-start;
      background: white;
      padding: 15px 20px;
      border-radius: 18px;
      border-bottom-left-radius: 6px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: 1px solid #e9ecef;
    }

    .typing-dots {
      display: flex;
      gap: 4px;
    }

    .typing-dots span {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #57A438;
      animation: typing 1.4s infinite;
    }

    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typing {
      0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
      30% { transform: translateY(-10px); opacity: 1; }
    }

    .status-indicator {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.9rem;
      color: #6c757d;
      margin-top: 10px;
    }

    .status-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #28a745;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.5; }
      100% { opacity: 1; }
    }

    /* Scrollbar styling */
    .chat-messages::-webkit-scrollbar {
      width: 6px;
    }

    .chat-messages::-webkit-scrollbar-track {
      background: #f1f3f4;
      border-radius: 10px;
    }

    .chat-messages::-webkit-scrollbar-thumb {
      background: #57A438;
      border-radius: 10px;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
      background: #F09F38;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      body {
        padding: 10px;
      }
      
      .header h1 {
        font-size: 1.8rem;
      }
      
      .chat-content {
        padding: 20px;
      }
      
      .faq-grid {
        grid-template-columns: 1fr;
      }
      
      .chat-container {
        height: 400px;
      }
      
      .message {
        max-width: 85%;
      }
    }

    @media (max-width: 480px) {
      .header {
        padding: 20px;
      }
      
      .chat-content {
        padding: 15px;
      }
      
      .chat-container {
        height: 350px;
      }
    }
  </style>
</head>
<body>

<div class="main-container">
  <div class="header">
    <h1><i class="fas fa-home"></i> Kost Assistant</h1>
    <p>Chat cerdas untuk informasi kost terbaik</p>
  </div>

  <div class="chat-content">
    <!-- FAQ Section -->
    <div class="faq-section">
      <h3 class="faq-title">
        <i class="fas fa-question-circle"></i>
        Pertanyaan Populer
      </h3>
      <div class="faq-grid">
        <div class="faq-question">💰 Berapa harga sewa per bulan?</div>
        <div class="faq-question">🏠 Apa saja fasilitas yang tersedia?</div>
        <div class="faq-question">🚿 Apakah kamar mandi di dalam atau luar?</div>
        <div class="faq-question">👥 Apakah kost campur, khusus putra, atau khusus putri?</div>
        <div class="faq-question">🕐 Apakah ada jam malam?</div>
        <div class="faq-question">📅 Apakah bisa sewa harian/mingguan/bulanan?</div>
        <div class="faq-question">📝 Apakah bisa booking dulu sebelum bayar?</div>
        <div class="faq-question">💳 Bagaimana cara bayar dan sistem sewa?</div>
        <div class="faq-question">🏧 Apakah bisa bayar via transfer?</div>
        <div class="faq-question">📞 Bagaimana cara memesan kamar?</div>
        <div class="faq-question">🐕 Boleh tidak membawa hewan peliharaan?</div>
        <div class="faq-question">👨‍🍳 Apakah tersedia dapur untuk memasak?</div>
      </div>
    </div>

    <!-- Chat Container -->
    <div class="chat-container">
      <div class="chat-header">
        <i class="fas fa-comments"></i>
        <span>Live Chat</span>
        <div class="ms-auto status-indicator">
          <div class="status-dot"></div>
          <span>Online</span>
        </div>
      </div>
      
      <div class="chat-messages" id="chat-messages">
        <div class="message bot">
          <i class="fas fa-robot" style="margin-right: 8px; opacity: 0.7;"></i>
          Halo! Selamat datang di <strong>Kost Sejahtera</strong>! 🏠<br><br>
          Saya adalah asisten virtual yang siap membantu Anda menemukan informasi tentang kost kami. Silakan pilih pertanyaan di atas atau tanya langsung tentang:
          <br><br>
          💰 Harga sewa dan fasilitas<br>
          🏠 Tipe kamar dan ketersediaan<br>
          📝 Cara booking dan pembayaran<br>
          📞 Kontak dan alamat lengkap<br>
          <br>
          Tanya apa saja, saya siap membantu! 😊
        </div>
        
        <div class="typing-indicator" id="typing-indicator">
          <div class="typing-dots">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Input Form -->
    <form id="input-form" class="input-container">
      <div class="input-wrapper">
        <textarea 
          id="question-input" 
          placeholder="Ketik pertanyaan Anda di sini..." 
          rows="1"
          style="min-height: 55px; max-height: 120px;"
        ></textarea>
      </div>
      <button type="submit" class="send-button">
        <i class="fas fa-paper-plane"></i>
      </button>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const chatMessages = document.getElementById('chat-messages');
  const form = document.getElementById('input-form');
  const input = document.getElementById('question-input');
  const typingIndicator = document.getElementById('typing-indicator');

  // Auto-resize textarea
  input.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
  });

  // Handle Enter key
  input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      form.dispatchEvent(new Event('submit'));
    }
  });

  function addMessage(text, sender) {
    const message = document.createElement('div');
    message.classList.add('message', sender);
    
    if (sender === 'bot') {
      message.innerHTML = `<i class="fas fa-robot" style="margin-right: 8px; opacity: 0.7;"></i>${text}`;
    } else {
      message.textContent = text;
    }
    
    chatMessages.appendChild(message);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function showTypingIndicator() {
    typingIndicator.style.display = 'block';
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function hideTypingIndicator() {
    typingIndicator.style.display = 'none';
  }

  // Database jawaban untuk pertanyaan kost
  const kostAnswers = {
    // Pertanyaan harga
    'harga': {
      keywords: ['harga', 'sewa', 'biaya', 'tarif', 'murah', 'mahal', 'budget', 'bulan', 'bulanan'],
      answers: [
        "Harga sewa kost bervariasi tergantung fasilitas dan lokasi:\n\n💰 **Kost Ekonomis**: Rp 800.000 - Rp 1.200.000/bulan\n💰 **Kost Standard**: Rp 1.200.000 - Rp 2.000.000/bulan\n💰 **Kost Premium**: Rp 2.000.000 - Rp 3.500.000/bulan\n\nHarga sudah termasuk listrik dan air. Untuk info lebih detail, silakan hubungi kami! 📞",
        "Berikut range harga kost yang tersedia:\n\n🏠 **Kamar Sharing**: Rp 600.000 - Rp 900.000/bulan\n🏠 **Kamar Pribadi**: Rp 1.000.000 - Rp 2.500.000/bulan\n🏠 **Kamar AC + Kamar Mandi Dalam**: Rp 1.800.000 - Rp 3.000.000/bulan\n\nAda diskon untuk sewa 6 bulan atau lebih! 🎉"
      ]
    },
    
    // Pertanyaan fasilitas
    'fasilitas': {
      keywords: ['fasilitas', 'lengkap', 'ada', 'tersedia', 'wifi', 'ac', 'kulkas', 'lemari'],
      answers: [
        "Fasilitas kost yang tersedia:\n\n🛏️ **Kamar**: Kasur, lemari, meja belajar, kursi\n🌐 **Internet**: WiFi gratis 24 jam\n❄️ **AC**: Tersedia di semua kamar premium\n🚿 **Kamar Mandi**: Dalam/luar sesuai tipe kamar\n🍽️ **Dapur**: Dapur bersama + kulkas\n🧺 **Laundry**: Mesin cuci coin\n🔒 **Keamanan**: CCTV + security 24 jam\n🏍️ **Parkir**: Motor dan mobil tersedia",
        "Kost kami dilengkapi dengan:\n\n✅ Kasur spring bed + bantal guling\n✅ Lemari pakaian 2 pintu\n✅ Meja belajar + kursi\n✅ WiFi unlimited speed tinggi\n✅ Air panas (tipe premium)\n✅ Kulkas bersama\n✅ Dispenser air minum\n✅ Area jemur pakaian\n✅ Mushola\n✅ Area parkir luas dan aman"
      ]
    },
    
    // Pertanyaan kamar mandi
    'kamar_mandi': {
      keywords: ['kamar mandi', 'toilet', 'wc', 'dalam', 'luar', 'bersama', 'pribadi'],
      answers: [
        "Untuk kamar mandi tersedia 2 pilihan:\n\n🚿 **Kamar Mandi Dalam**: \n- Tersedia di kamar tipe premium\n- Dilengkapi shower + water heater\n- Harga mulai Rp 1.800.000/bulan\n\n🚿 **Kamar Mandi Luar**: \n- Kamar mandi bersama (1:4 ratio)\n- Selalu bersih dan terawat\n- Harga mulai Rp 800.000/bulan\n\nSemua kamar mandi dilengkapi dengan air panas! 🔥",
        "Pilihan kamar mandi:\n\n🏠 **Kamar Mandi Pribadi (Dalam)**:\n- Air panas 24 jam\n- Shower + bathtub (tipe tertentu)\n- Perlengkapan mandi disediakan\n\n🏠 **Kamar Mandi Bersama (Luar)**:\n- Rasio 1 kamar mandi untuk 3-4 kamar\n- Dibersihkan 2x sehari\n- Antrian jarang karena banyak kamar mandi"
      ]
    },
    
    // Pertanyaan tipe kost
    'tipe_kost': {
      keywords: ['campur', 'putra', 'putri', 'cowok', 'cewek', 'pria', 'wanita', 'khusus'],
      answers: [
        "Tipe kost yang tersedia:\n\n👨 **Kost Putra**: Khusus laki-laki\n- Lantai 1 & 2\n- 25 kamar tersedia\n- Suasana nyaman untuk mahasiswa/pekerja\n\n👩 **Kost Putri**: Khusus perempuan\n- Lantai 3 & 4\n- 30 kamar tersedia\n- Keamanan extra ketat\n\n👥 **Kost Campur**: \n- Lantai terpisah putra-putri\n- Area common yang bisa digunakan bersama\n- Aturan berkunjung sampai jam 21:00",
        "Kami menyediakan:\n\n🏠 **Kost Khusus Putra**:\n- Bebas bertamu sesama cowok\n- Fasilitas gym mini\n- Area nongkrong outdoor\n\n🏠 **Kost Khusus Putri**:\n- Keamanan 24 jam dengan security wanita\n- Area dapur khusus perempuan\n- Salon mini untuk perawatan\n\n🏠 **Kost Campur**:\n- Aturan ketat untuk menjaga kenyamanan\n- Jam bertamu terbatas\n- CCTV di area umum"
      ]
    },
    
    // Pertanyaan jam malam
    'jam_malam': {
      keywords: ['jam malam', 'curfew', 'pulang', 'tutup', 'batas', 'waktu'],
      answers: [
        "Aturan jam malam:\n\n🕘 **Weekdays (Senin-Jumat)**: \n- Gerbang tutup jam 23:00\n- Masuk terakhir jam 22:45\n- Untuk keperluan darurat bisa koordinasi\n\n🕘 **Weekend (Sabtu-Minggu)**: \n- Gerbang tutup jam 24:00\n- Lebih fleksibel untuk acara khusus\n\n⚠️ **Catatan**: \n- Pelanggaran 3x akan mendapat teguran\n- Ada sistem kunci digital untuk emergensi\n- Bisa request perpanjangan untuk shift malam",
        "Jam operasional kost:\n\n🔓 **Buka**: 05:00 - 23:00 (Senin-Jumat)\n🔓 **Buka**: 05:00 - 00:00 (Sabtu-Minggu)\n\n🔐 **Setelah jam tutup**:\n- Tersedia access card khusus\n- Koordinasi dengan security\n- Biaya tambahan Rp 10.000 jika lewat jam 01:00\n\n👥 **Tamu**:\n- Jam berkunjung: 08:00 - 21:00\n- Wajib lapor ke security\n- Maksimal 2 orang per kunjungan"
      ]
    },
    
    // Pertanyaan sistem sewa
    'sistem_sewa': {
      keywords: ['sewa', 'harian', 'mingguan', 'bulanan', 'kontrak', 'durasi'],
      answers: [
        "Sistem sewa yang tersedia:\n\n📅 **Sewa Harian**: \n- Rp 50.000-80.000/hari\n- Minimal 3 hari\n- Cocok untuk keperluan sementara\n\n📅 **Sewa Mingguan**: \n- Rp 300.000-450.000/minggu\n- Minimal 2 minggu\n- Hemat 15% dari harga harian\n\n📅 **Sewa Bulanan**: \n- Harga paling ekonomis\n- Minimal kontrak 3 bulan\n- Bonus 1 minggu gratis untuk kontrak 1 tahun",
        "Pilihan durasi sewa:\n\n⏰ **Jangka Pendek**:\n- Harian: Mulai Rp 45.000\n- Mingguan: Mulai Rp 280.000\n- Cocok untuk training, kursus, atau keperluan sementara\n\n⏰ **Jangka Panjang**:\n- Bulanan: Paling populer dan hemat\n- 6 bulan: Diskon 5%\n- 1 tahun: Diskon 10% + bonus\n\n📋 **Syarat**: KTP, foto, uang muka 1 bulan"
      ]
    },
    
    // Pertanyaan booking
    'booking': {
      keywords: ['booking', 'pesan', 'reservasi', 'dp', 'uang muka'],
      answers: [
        "Cara booking kamar:\n\n📝 **Step 1**: Pilih kamar yang diinginkan\n📝 **Step 2**: Bayar DP Rp 200.000 (bisa refund)\n📝 **Step 3**: Isi form data diri\n📝 **Step 4**: Konfirmasi via WhatsApp\n\n💳 **Pembayaran DP**:\n- Transfer bank\n- E-wallet (GoPay, OVO, Dana)\n- Cash di tempat\n\n⏰ **Booking Hold**: Maksimal 7 hari\n🔄 **Refund**: 100% jika batal dalam 24 jam",
        "Sistem booking kost:\n\n🏠 **Online Booking**:\n- Chat WhatsApp: 0812-3456-7890\n- Website: www.kostkita.com\n- Aplikasi mobile tersedia\n\n💰 **Uang Muka**:\n- DP minimal Rp 200.000\n- Langsung dipotong dari pembayaran bulan pertama\n- Bisa bayar via transfer atau e-wallet\n\n✅ **Konfirmasi**: Dalam 2 jam setelah pembayaran\n📸 **Virtual Tour**: Tersedia video call untuk lihat kamar"
      ]
    },
    
    // Pertanyaan pembayaran
    'pembayaran': {
      keywords: ['bayar', 'transfer', 'cash', 'tunai', 'pembayaran', 'rekening'],
      answers: [
        "Metode pembayaran tersedia:\n\n🏧 **Transfer Bank**:\n- BCA: 1234567890 (a.n. Kost Sejahtera)\n- Mandiri: 0987654321\n- BRI: 1122334455\n- BNI: 9988776655\n\n📱 **E-Wallet**:\n- GoPay: 0812-3456-7890\n- OVO: 0812-3456-7890\n- Dana: 0812-3456-7890\n- ShopeePay: 0812-3456-7890\n\n💵 **Cash**: Bayar di tempat (kantor kost)\n💳 **Kartu Kredit**: Tersedia EDC di lokasi",
        "Sistem pembayaran:\n\n📅 **Jatuh Tempo**: Setiap tanggal masuk kost\n⏰ **Grace Period**: 3 hari setelah jatuh tempo\n💰 **Denda**: Rp 50.000 jika telat > 3 hari\n\n🧾 **Bukti Bayar**:\n- Kuitansi resmi\n- Struk digital via WhatsApp\n- Invoice email\n\n🎯 **Auto Debit**: Tersedia untuk sewa bulanan\n📊 **Cicilan**: Bisa dicicil 2x untuk sewa 6 bulan+"
      ]
    },
    
    // Pertanyaan cara pesan
    'cara_pesan': {
      keywords: ['pesan', 'order', 'hubungi', 'kontak', 'alamat'],
      answers: [
        "Cara memesan kamar kost:\n\n📞 **Kontak Kami**:\n- WhatsApp: 0812-3456-7890 (24 jam)\n- Telp: (0274) 123-4567\n- Email: info@kostsejahtera.com\n\n📍 **Alamat**: \nJl. Malioboro No. 123, Yogyakarta\n(Dekat Universitas Gadjah Mada)\n\n🕒 **Jam Kantor**: \n- Senin-Sabtu: 08:00-20:00\n- Minggu: 09:00-17:00\n\n🏠 **Kunjungan**: Survey lokasi welcome anytime!",
        "Hubungi kami untuk pemesanan:\n\n💬 **WhatsApp Business**: 0812-3456-7890\n- Respon cepat dalam 5 menit\n- Bisa video call untuk tour virtual\n- Customer service 24/7\n\n🌐 **Website**: www.kostsejahtera.com\n- Booking online langsung\n- Lihat foto kamar real-time\n- Cek ketersediaan kamar\n\n📱 **Aplikasi Mobile**: \n- Download di Play Store/App Store\n- 'Kost Sejahtera App'\n- Notifikasi promo & update"
      ]
    },
    
    // Pertanyaan hewan peliharaan
    'hewan_peliharaan': {
      keywords: ['hewan', 'peliharaan', 'kucing', 'anjing', 'pet', 'binatang'],
      answers: [
        "Kebijakan hewan peliharaan:\n\n🐱 **Diizinkan**:\n- Kucing (maksimal 1 ekor)\n- Ikan hias dalam akuarium\n- Burung kecil dalam sangkar\n\n🚫 **Tidak Diizinkan**:\n- Anjing (karena ruang terbatas)\n- Hewan exotic (iguana, ular, dll)\n- Hewan yang menimbulkan bau/suara\n\n📋 **Syarat**:\n- Deposit tambahan Rp 500.000\n- Vaksin lengkap + sertifikat kesehatan\n- Bertanggung jawab atas kebersihan",
        "Aturan hewan peliharaan di kost:\n\n✅ **Boleh Bawa**:\n- Kucing domestik (sudah steril)\n- Hamster, kelinci mini\n- Ikan hias & burung kecil\n\n❌ **Tidak Diperbolehkan**:\n- Anjing ras besar\n- Reptil & amfibi\n- Hewan yang berbahaya\n\n💡 **Tips**: \n- Koordinasi dengan penghuni lain\n- Jaga kebersihan area bersama\n- Ada pet care service nearby jika perlu"
      ]
    },
    
    // Pertanyaan dapur
    'dapur': {
      keywords: ['dapur', 'masak', 'memasak', 'kompor', 'kulkas', 'kitchen'],
      answers: [
        "Fasilitas dapur kost:\n\n🍳 **Dapur Bersama**:\n- Kompor gas 4 tungku\n- Kulkas 2 pintu (freezer tersedia)\n- Microwave & rice cooker\n- Peralatan masak lengkap\n- Sink cuci piring + sabun\n\n⏰ **Jam Operasional**: 05:00 - 22:00\n\n📋 **Aturan**:\n- Bersihkan setelah pakai\n- Label makanan di kulkas\n- Jangan simpan makanan > 3 hari\n- Piket kebersihan bergantian",
        "Fasilitas memasak tersedia:\n\n👨‍🍳 **Peralatan Dapur**:\n- Gas stove 6 tungku (LPG)\n- Kulkas besar + freezer\n- Dispenser air panas/dingin\n- Rice cooker, blender, microwave\n- Panci, wajan, spatula lengkap\n- Piring, gelas, sendok garpu\n\n🧽 **Cleaning Supplies**:\n- Sabun cuci piring gratis\n- Spons & sikat tersedia\n- Tisu & lap bersih\n\n⚠️ **Catatan**: Dapur ditutup jam 10 malam untuk menjaga ketenangan"
      ]
    }
  };

  function getRandomAnswer(answers) {
    return answers[Math.floor(Math.random() * answers.length)];
  }

  function findBestMatch(question) {
    question = question.toLowerCase();
    let bestMatch = null;
    let maxScore = 0;

    for (const [category, data] of Object.entries(kostAnswers)) {
      let score = 0;
      for (const keyword of data.keywords) {
        if (question.includes(keyword)) {
          score += keyword.length; // Keyword yang lebih panjang mendapat skor lebih tinggi
        }
      }
      
      if (score > maxScore) {
        maxScore = score;
        bestMatch = data;
      }
    }

    return bestMatch;
  }

  function sendQuestion(question) {
    addMessage(question, 'user');
    showTypingIndicator();
    
    // Coba cari jawaban dari database lokal dulu
    const matchedAnswer = findBestMatch(question);
    
    if (matchedAnswer) {
      // Jika ada jawaban yang cocok, gunakan itu
      setTimeout(() => {
        hideTypingIndicator();
        const answer = getRandomAnswer(matchedAnswer.answers);
        addMessage(answer, 'bot');
      }, 1000 + Math.random() * 1500);
    } else {
      // Jika tidak ada yang cocok, coba API atau berikan jawaban default
      $.ajax({
        url: 'http://127.0.0.1:5000/predict',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ question: question }),
        dataType: 'json',
        success: function(data) {
          setTimeout(() => {
            hideTypingIndicator();
            addMessage(data.answer, 'bot');
          }, 1000 + Math.random() * 1000);
        },
        error: function(xhr, status, error) {
          setTimeout(() => {
            hideTypingIndicator();
            // Berikan jawaban default yang membantu
            const defaultAnswer = `Maaf, saya belum bisa menjawab pertanyaan "${question}" secara spesifik. \n\n💬 Untuk informasi lebih detail tentang:\n• Harga dan fasilitas\n• Booking dan pembayaran\n• Aturan kost\n\nSilakan hubungi kami langsung:\n📞 WhatsApp: 0812-3456-7890\n📧 Email: info@kostsejahtera.com\n\nAtau pilih dari pertanyaan umum di atas! 😊`;
            addMessage(defaultAnswer, 'bot');
          }, 800);
          console.error("Error:", error);
        }
      });
    }
  }

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const question = input.value.trim();
    if (!question) return;
    
    input.value = '';
    input.style.height = '55px';
    sendQuestion(question);
  });

  // Event listener untuk FAQ questions
  document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
      const question = item.textContent.replace(/^[^\s]+\s/, ''); // Remove emoji
      sendQuestion(question);
    });
  });

  // Add some interactive effects
  document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-2px) scale(1.02)';
    });
    
    item.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
    });
  });
</script>

</body>
</html>