<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>

<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body{
  background: #f4f6f9;
}

/* ===== PROFILE CONTAINER ===== */
.profile-container {
  padding-bottom: 40px;
  max-width: 1000px;
  margin: auto;
}

/* ===== HEADER ===== */
.profile-header {
  display: flex;
  align-items: center;
  gap: 20px;
  background: linear-gradient(#7fa6d8, #3f6fb3);
  padding: 25px;
  border-radius: 15px;
  margin: 20px;
  color: white;
}

.profile-avatar {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  border: 3px solid white;
  object-fit: cover;
}

.profile-header h2 {
  margin-bottom: 5px;
}

/* ===== CARD ===== */
.profile-card {
  background: white;
  margin: 20px;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

.profile-card h3 {
  margin-bottom: 10px;
}

/* ===== INFO TEXT ===== */
.profile-info p {
  margin: 6px 0;
}

/* ===== BUTTON ===== */
.profile-btn {
  padding: 10px 18px;
  border: none;
  border-radius: 10px;
  background: #2f5f9f;
  color: white;
  margin-top: 10px;
  cursor: pointer;
  transition: 0.3s;
}

.profile-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 12px rgba(0,0,0,0.15);
}

.profile-btn.logout {
  background: #d9534f;
}

.profile-btn.history {
  background: #5cb85c;
}

/* ============================= */
/* ======== RESPONSIVE ========= */
/* ============================= */

/* Tablet */
@media (max-width: 992px) {
  .profile-header {
    padding: 20px;
  }
}

/* Mobile */
@media (max-width: 768px) {

  .profile-header {
    flex-direction: column;
    text-align: center;
    gap: 15px;
  }

  .profile-avatar {
    width: 75px;
    height: 75px;
  }

  .profile-card {
    margin: 15px;
    padding: 18px;
  }

  .profile-btn {
    width: 100%;
  }
}

/* Small Mobile */
@media (max-width: 480px) {

  .profile-header {
    margin: 15px;
    padding: 18px;
  }

  .profile-avatar {
    width: 65px;
    height: 65px;
  }

  .profile-card {
    margin: 12px;
    padding: 15px;
  }

  .profile-card h3 {
    font-size: 16px;
  }
}
</style>
</head>

<body>

<div class="profile-container">

  <!-- Profile Header -->
  <div class="profile-header">
    <img src="{{ asset('images/pp_default.jpg') }}" class="profile-avatar" alt="Profile">
    <div>
      <h4>{{ $kantin->nama }}</h4>
      <p>kantin {{ $kantin->no_kantin }}</p>
      <button class="profile-btn">Edit Profil</button>
    </div>
  </div>

  <!-- Info Card -->
  <div class="profile-card">
    <h3>Informasi Akun</h3>
    <div class="profile-info">
      <p><b>Username:</b> {{ $kantin->nama }}</p>
      <p><b>No kantin:</b> {{ $kantin->no_kantin }}</p>
      <p><b>No hp:</b> {{ $kantin->no_hp }}</p>
    </div>
  </div>

  <!-- Riwayat Card -->
  <div class="profile-card">
    <h3>Lihat Menu</h3>
    <a href="{{ route('daftar_menu') }}">
      <button class="profile-btn history">Daftar menu</button>
    </a>
  </div>

  <div class="profile-card">
    <h3>Riwayat Penjualan</h3>
    <a href="{{ route('dashboard.riwayat') }}">
      <button class="profile-btn history">Lihat Riwayat</button>
    </a>
  </div>

  <!-- Setting Card -->
  <div class="profile-card">
    <h3>Setting</h3>
    <form action="{{ route('logout.kantin') }}" method="POST">
      @csrf
      <button type="submit" class="profile-btn logout">
          Logout
      </button>
  </form>
  </div>

</div>

</body>
</html>
