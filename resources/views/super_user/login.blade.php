<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="{{ asset('css/akun.css') }}">
</head>

<style>

/* ================= RESET ================= */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
}

body {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #1e293b;
  padding: 20px;
}

/* ================= HEADER ================= */
.header {
  position: absolute;
  top: 0;
  width: 100%;
  padding: 20px;
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  color: white;
  letter-spacing: 1px;
}

/* ================= CONTAINER ================= */
.container {
  width: 100%;
  max-width: 420px;
}

/* ================= CARD ================= */
.card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 35px 30px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
  animation: fadeIn 0.5s ease-in-out;
}

.card h3 {
  text-align: center;
  margin-bottom: 25px;
  color: #1e293b;
  font-size: 22px;
}

/* ================= FORM ================= */
.form-group {
  margin-bottom: 18px;
}

.form-group label {
  display: block;
  margin-bottom: 6px;
  font-size: 13px;
  font-weight: 600;
  color: #444;
}

.form-group input {
  width: 100%;
  padding: 13px;
  border-radius: 12px;
  border: 1px solid #ddd;
  font-size: 14px;
  transition: all 0.2s ease;
}

/* INPUT FOCUS */
.form-group input:focus {
  outline: none;
  border-color: #1e293b;
  box-shadow: 0 0 0 3px rgba(47, 95, 159, 0.15);
}

/* ================= BUTTON ================= */
.btn-daftar {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 14px;
  background: #1e293b;
  color: white;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 10px;
  transition: all 0.3s ease;
}

.btn-daftar:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(47,95,159,0.3);
}

/* ================= FOOTER ================= */
.footer-text {
  margin-top: 18px;
  text-align: center;
  font-size: 13px;
  color: #666;
}

.footer-text a {
  color: #2f5f9f;
  font-weight: 600;
  text-decoration: none;
}

.footer-text a:hover {
  text-decoration: underline;
}

/* ================= ANIMATION ================= */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 480px) {
  .card {
    padding: 25px 20px;
  }

  .header {
    font-size: 18px;
  }
}

</style>


<body>

<div class="header">Login Super User</div>

<div class="container">
  <div class="card">
    <h3>Buat Akun Baru</h3>

    <form action="{{ route('admin.flogin') }}" method="POST">
      @csrf

      <!-- Nama -->
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
      </div>

      <!-- Password -->
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>
      </div>

      <button type="submit" class="btn-daftar">Login</button>
      @if(session('error'))
        <div style="color:red;">
            {{ session('error') }}
        </div>
      @endif
    </form>

  </div>
</div>

</body>
</html>
