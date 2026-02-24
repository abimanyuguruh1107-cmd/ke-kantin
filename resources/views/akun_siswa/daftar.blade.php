<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
</head>

<style>
  * {
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  margin: 0;
  background: #f2f5f9;
}

/* HEADER */
.header {
  background: linear-gradient(#7fa6d8, #3f6fb3);
  color: white;
  padding: 16px;
  text-align: center;
  font-size: 20px;
  font-weight: bold;
}

/* CONTAINER */
.container {
  padding: 16px;
}

/* CARD */
.card {
  background: white;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.card h3 {
  margin-top: 0;
  margin-bottom: 16px;
  color: #3f6fb3;
  text-align: center;
}

/* FORM */
.form-group {
  margin-bottom: 14px;
}

.form-group label {
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
  font-weight: bold;
  color: #333;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
  background-color: #fff;
}

/* INPUT & SELECT FOCUS */
.form-group input:focus,
.form-group select:focus {
  outline: none;
  border-color: #3f6fb3;
  box-shadow: 0 0 0 2px rgba(63, 111, 179, 0.15);
}

/* DROPDOWN STYLE */
.form-group select {
  cursor: pointer;

  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;

  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%233f6fb3'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  background-size: 18px;
}

.form-group select:hover {
  border-color: #7fa6d8;
}

.form-group select option {
  font-size: 14px;
}

/* BUTTON */
.btn-daftar {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 10px;
  background: linear-gradient(#7fa6d8, #3f6fb3);
  color: white;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  margin-top: 10px;
  transition: opacity 0.2s ease;
}

.btn-daftar:hover {
  opacity: 0.9;
}

/* FOOTER TEXT */
.footer-text {
  margin-top: 14px;
  text-align: center;
  font-size: 14px;
}

.footer-text a {
  color: #3f6fb3;
  text-decoration: none;
  font-weight: bold;
}

.footer-text a:hover {
  text-decoration: underline;
}

/* NIS WRAPPER */
.nis-wrapper {
  display: flex;
  gap: 8px;
}

.nis-wrapper input {
  flex: 1;
}

/* BUTTON CEK */
.btn-cek {
  padding: 0 16px;
  border: none;
  border-radius: 8px;
  background: #3f6fb3;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: 0.2s;
}

.btn-cek:hover {
  opacity: 0.9;
}


</style>

<body>

<div class="header">Daftar Akun Siswa</div>

<div class="container">
  <div class="card">
    <h3>Buat Akun Baru</h3>

    @if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('fdaftar') }}" method="POST">
      @csrf

      <!-- NIS -->
      <div class="form-group">
        <label>NIS</label>
        <div class="nis-wrapper">
          <input type="text" name="nis" id="nis" placeholder="Masukkan NIS" required>
          <button type="button" class="btn-cek" onclick="cekNIS()">Cek</button>
        </div>
        <small id="nis-info" style="display:block; margin-top:6px;"></small>
      </div>


      <!-- Nama -->
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
      </div>

      <!-- No HP -->
      <div class="form-group">
        <label>No. HP</label>
        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx">
      </div>

      <!-- Kelas -->
      <div class="form-group">
        <label>Kelas</label>
        <select name="kelas" required>
          <option value="">-- Pilih Kelas --</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
      </div>

      <!-- Jurusan -->
      <div class="form-group">
        <label>Jurusan</label>
        <select name="jurusan" required>
          <option value="">-- Pilih Jurusan --</option>
          <option value="RPL">RPL</option>
          <option value="TKJ">TKJ</option>
          <option value="DKV">DKV</option>
          <option value="TITL">TITL</option>
          <option value="TPL">TPL</option>
          <option value="TP">TP</option>
          <option value="TKR">TKR</option>
          <option value="TSM">TSM</option>
        </select>
      </div>

      <!-- Password -->
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>
      </div>

      <!-- Konfirmasi Password -->
      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
      </div>

      @error('password')
        <div style="color:red">{{ $message }}</div>
      @enderror

      <button type="submit" class="btn-daftar">Daftar</button>

      <div class="footer-text">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
      </div>
    </form>

  </div>
</div>

</body>
</html>
