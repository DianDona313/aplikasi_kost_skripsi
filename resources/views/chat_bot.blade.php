<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chat Kost Assistant</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

    #chat-container {
      width: 100%;
      max-width: 700px;
      margin: 50px auto;
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .message {
      padding: 10px 15px;
      margin: 10px 0;
      border-radius: 5px;
      max-width: 80%;
    }

    .user {
      background-color: #d1e7dd;
      align-self: flex-end;
      text-align: right;
      margin-left: auto;
    }

    .bot {
      background-color: #f8d7da;
      align-self: flex-start;
      margin-right: auto;
    }

    #chat-box {
      display: flex;
      flex-direction: column;
      height: 400px;
      overflow-y: auto;
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 15px;
    }

    #input-form {
      display: flex;
    }

    #question-input {
      flex: 1;
      padding: 10px;
      font-size: 16px;
    }

    #send-button {
      padding: 10px 20px;
      font-size: 16px;
      background: #0d6efd;
      color: white;
      border: none;
      cursor: pointer;
    }

    #send-button:hover {
      background: #0b5ed7;
    }

    #faq-list {
      margin-bottom: 20px;
    }

    .faq-question {
      cursor: pointer;
      background-color: #e9ecef;
      border: 1px solid #ced4da;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 5px;
      transition: background-color 0.2s;
    }

    .faq-question:hover {
      background-color: #dfe3e6;
    }
  </style>
</head>
<body>

<div id="chat-container">
  <h2 class="text-center">Kost Assistant Chat</h2>

  <!-- Pertanyaan pilihan -->
  <div id="faq-list">
    <h5>Pertanyaan Umum:</h5>
    <div class="faq-question">Berapa harga sewa per bulan?</div>
    <div class="faq-question">Apa saja fasilitas yang tersedia?</div>
    <div class="faq-question">Apakah kamar mandi di dalam atau luar?</div>
    <div class="faq-question">Apakah kost campur, khusus putra, atau khusus putri?</div>
    <div class="faq-question">Apakah ada jam malam?</div>
    <div class="faq-question">Apakah bisa sewa harian/mingguan/bulanan?</div>
    <div class="faq-question">Apakah bisa booking dulu sebelum bayar?</div>
    <div class="faq-question">Bagaimana cara bayar dan sistem sewa?</div>
    <div class="faq-question">Apakah bisa bayar via transfer?</div>
    <div class="faq-question">Bagaimana cara memesan kamar?</div>
    <div class="faq-question">Boleh tidak membawa hewan peliharaan?</div>
    <div class="faq-question">Apakah tersedia dapur untuk memasak?</div>
    <div class="faq-question">Apakah semua kost menyediakan dapur umum?</div>
  </div>

  <!-- Kotak chat -->
  <div id="chat-box"></div>

  <!-- Form input manual -->
  <form id="input-form" class="d-flex">
    <input type="text" id="question-input" class="form-control" placeholder="Tulis pertanyaan Anda..." required />
    <button type="submit" id="send-button" class="btn btn-primary">Kirim</button>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const chatBox = document.getElementById('chat-box');
  const form = document.getElementById('input-form');
  const input = document.getElementById('question-input');

  function addMessage(text, sender) {
    const message = document.createElement('div');
    message.classList.add('message', sender);
    message.textContent = text;
    chatBox.appendChild(message);
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  function sendQuestion(question) {
    addMessage(question, 'user');
    $.ajax({
      url: 'http://127.0.0.1:5000/predict',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({ question: question }),
      dataType: 'json',
      success: function(data) {
        addMessage(data.answer, 'bot');
      },
      error: function(xhr, status, error) {
        addMessage("Terjadi kesalahan. Coba lagi.", 'bot');
        console.error("Error:", error);
      }
    });
  }

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const question = input.value.trim();
    if (!question) return;
    input.value = '';
    sendQuestion(question);
  });

  // Event listener untuk daftar pertanyaan
  document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
      const question = item.textContent;
      sendQuestion(question);
    });
  });
</script>

</body>
</html>
