<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Kantin</title>

<style>

/* RESET */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Arial, sans-serif;
}

body{
  background:#eef1f6;
  overflow-x:hidden;
}

a{
  text-decoration:none;
  color:inherit;
}

/* LAYOUT */
.app{
  display:flex;
  min-height:100vh;
}

/* ================================================= */
/* ================= 3. SIDEBAR ==================== */
/* ================================================= */

.sidebar{
  width:240px;
  background:#2f5f9f;
  color:white;
  padding:20px;
  transition:0.3s;
  box-shadow: 4px 0 12px rgba(0,0,0,0.15);
}

.sidebar ul li.active{
  background: #3f6fb3;
}

.sidebar h2{
  margin-bottom:25px;
}

.sidebar ul{
  list-style:none;
}

.sidebar li{
  padding:12px 10px;
  border-radius:8px;
  margin-bottom:5px;
  cursor:pointer;
  transition:0.2s;
}

.sidebar li:hover{
  background:rgba(255,255,255,0.15);
}

.sidebar a{
  display:flex;
  align-items:center;
  gap:12px;
}

.sidebar img{
  width:20px;
  height:20px;
}

/* ===== CONTENT ===== */
.content{
  flex:1;
  display:flex;
  flex-direction:column;
}

/* HEADER */
.header{
  background:#2f5f9f;
  padding:18px 25px;
  color:white;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.user{
  display:flex;
  align-items:center;
  gap:12px;
}

.avatar{
  width:42px;
  height:42px;
  border-radius:50%;
  object-fit:cover;
  border:2px solid white;
}

.menu-toggle{
  font-size:24px;
  cursor:pointer;
  display:none;
}

/* CONTENT AREA */
.isi{
  padding:30px;
  flex:1;
}

.history-title{
  font-size:22px;
  font-weight:bold;
  margin-bottom:20px;
  color:#2f5f9f;
}

/* CARD */
.sales-card{
  background:white;
  border-radius:15px;
  padding:20px;
  box-shadow:0 6px 15px rgba(0,0,0,0.08);
}

.sales-item{
  border-bottom:1px solid #eee;
  padding:18px 0;
}

.sales-item:last-child{
  border-bottom:none;
}

.sales-top{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:10px;
}

.student-info{
  font-weight:bold;
}

.total-badge{
  background:#2f5f9f;
  color:white;
  padding:6px 12px;
  border-radius:8px;
  font-size:13px;
}

.sales-detail{
  font-size:14px;
  color:#555;
}

.sales-detail span{
  display:block;
  margin:3px 0;
}

/* OVERLAY */
.overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.4);
  display:none;
  z-index:98;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){

  .sidebar{
    position:fixed;
    left:-250px;
    top:0;
    height:100%;
    z-index:99;
  }

  .sidebar.active{
    left:0;
  }

  .menu-toggle{
    display:block;
  }

  .overlay.active{
    display:block;
  }

  .sales-top{
    flex-direction:column;
    align-items:flex-start;
    gap:8px;
  }

  .isi{
    padding:20px;
  }

}

</style>
</head>

<body>

<!-- OVERLAY -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="app">

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <h2>KE-Kantin</h2>
    <ul>
      <li><a href="{{ route('dashboard.kantin') }}"><img src="{{ asset('images/home.png') }}"><span>Dashboard</span></a></li>
      <li class="active"><a href="{{ route('riwayat.kantin') }}"><img src="{{ asset('images/riwayat.png') }}"><span>Riwayat</span></a></li>
      <li><a href="{{ route('tambah_menu') }}"><img src="{{ asset('images/tambah.png') }}"><span>Tambah Menu</span></a></li>
      <li><a href="{{ route('profile.kantin') }}"><img src="{{ asset('images/user.png') }}"><span>Profil</span></a></li>
    </ul>
  </aside>

<!-- CONTENT -->
<main class="content">

<header class="header">
  <div class="user">
    <img class="avatar" src="{{ asset('images/pp_default.jpg') }}">
    <div>
      <h4>{{ $kantin->nama }}</h4>
        <p>kantin {{ $kantin->no_kantin }}</p>
    </div>
  </div>
  <div class="menu-toggle" onclick="toggleMenu()">☰</div>
</header>

<div class="isi">

  <div class="history-title">
    Riwayat Transaksi
  </div>

 <div class="sales-card">

@forelse($transaksi as $item)

<div class="sales-item">
  <div class="sales-top">
    <div class="student-info">
      {{ $item->siswa->nama }} - {{ $item->siswa->kelas }} {{ $item->siswa->jurusan }}
    </div>

    <div class="total-badge">
      Rp {{ number_format($item->total_harga,0,',','.') }}
    </div>
  </div>

  <div class="sales-detail">

    <div class="card-item">
        <strong>Menu:</strong>
        <ul>
            @foreach($item->detail as $detail)
                <li>
                    {{ $detail->produk->kategori->nama_produk ?? $detail->produk->nama }} 
                    x{{ $detail->jumlah }}
                </li>
            @endforeach
        </ul>
    </div>


    <span style="display:inline-flex; align-items:center; gap:4px;">
      <b>Status:</b>
      @if($item->status == 'pending')
        <span style="color:#ffc107;">Pending</span>
      @elseif($item->status == 'selesai')
        <span style="color:#28a745;">Selesai</span>
      @else
        <span style="color:#dc3545;">Dibatalkan</span>
      @endif
    </span>

    <span><b>Tanggal:</b> {{ $item->created_at->format('d M Y H:i') }}</span>
  </div>
</div>
@empty
  <div style="text-align:center; padding:40px; color:#777;">
    Belum ada transaksi
  </div>
@endforelse
</div>

  </div>

</div>
</main>
</div>

<script>
function toggleMenu(){
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("overlay").classList.toggle("active");
}
</script>

</body>
</html>
