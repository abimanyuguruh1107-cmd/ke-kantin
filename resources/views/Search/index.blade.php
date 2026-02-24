<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search</title>

<style>

/* ===== RESET ===== */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body{
  background:#f4f6f9;
}

a{
  text-decoration:none;
  color:inherit;
}

/* ===== LAYOUT ===== */
.app{
  display:flex;
  min-height:100vh;
}

/* ===== SIDEBAR ===== */
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

/* ===== MAIN ===== */
.main{
  flex:1;
  display:flex;
  flex-direction:column;
}

.header{
  background:#2f5f9f;
  padding:15px 40px;
  color:white;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.user{
  display:flex;
  align-items:center;
  gap:10px;
}

.avatar{
  width:40px;
  height:40px;
  border-radius:50%;
  object-fit:cover;
}

.menu-toggle{
  display:none;
  font-size:22px;
  cursor:pointer;
}

.content{
  padding:30px 40px;
  overflow-y:auto;
}

/* ===== SEARCH ===== */
.search-box{
  margin-bottom:25px;
}

.search-box input{
  width:100%;
  max-width:400px;
  padding:12px 18px;
  border-radius:25px;
  border:none;
  outline:none;
  font-size:14px;
  background:#f2f4f7;
  box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

/* ===== GRID ===== */
.menu{
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(260px, 1fr));
  gap:25px;
}

/* ===== CARD ===== */
.menu-card{
  background:white;
  border-radius:15px;
  padding:15px;
  box-shadow:0 6px 15px rgba(0,0,0,0.08);
  transition:0.3s;
}

.menu-card img{
  width:100%;
  height:160px;
  object-fit:cover;
  border-radius:12px;
  margin-bottom:10px;
}

.menu-card p{
  font-weight:600;
  font-size:14px;
}

.menu-footer{
  margin-top:10px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.harga{
  font-weight:bold;
  color:#2f5f9f;
}

.btn-tambah{
  padding:6px 12px;
  border:none;
  border-radius:8px;
  background:#2f5f9f;
  color:white;
  cursor:pointer;
}/* ================= QTY ================= */
.qty-control{
  display:flex;
  flex-direction: column;
  align-items:center;
  gap:8px;
}

.qty-btn{
  width:32px;
  height:32px;
  border:none;
  background:#2f5f9f;
  color:white;
  border-radius:50%;
  cursor:pointer;
  font-weight:bold;
  font-size:16px;
  transition:0.2s;
}

.qty-btn:hover{
  background:#244a7a;
}

.qty-number{
  min-width:24px;
  text-align:center;
  font-weight:bold;
  font-size:14px;
  color:#2f5f9f;
  background:#f1f3f8;
  padding:4px 8px;
  border-radius:8px;
}

/* ===== PRODUK OFFLINE ===== */
.menu-card.offline{
  background:#e5e7eb;
  filter:grayscale(100%);
  opacity:0.75;
  pointer-events:none;
  position:relative;
}

.menu-card.offline:hover{
  transform:none;
  box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

.menu-card.offline::after{
  content:"Kantin Offline";
  position:absolute;
  top:8px;
  left:8px;
  background:#9ca3af;
  color:white;
  font-size:11px;
  padding:2px 6px;
  border-radius:6px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){

  .sidebar{
    position:fixed;
    left:-250px;
    top:0;
    height:100%;
    z-index:100;
  }

  .sidebar.active{
    left:0;
  }

  .menu-toggle{
    display:block;
  }

  .cart-summary{
    left:0;
  }

}

</style>
</head>

<body>

<div class="app">

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<aside class="sidebar" id="sidebar">
  <h2>KE-Kantin</h2>
  <ul>
    <li><a href="{{ route('index') }}"><img src="{{ asset('images/home.png') }}"><span>Home</span></a></li>
    <li class="active"><a href="{{ route('search') }}"><img src="{{ asset('images/search.png') }}"><span>Search</span></a></li>
    <li><a href="{{ route('keranjang.index') }}"><img src="{{ asset('images/grocery-store.png') }}"><span>Keranjang</span></a></li>
    <li><a href="{{ route('profile_page') }}"><img src="{{ asset('images/user.png') }}"><span>Profil</span></a></li>
  </ul>
</aside>

<div class="main">

<header class="header">
  <div class="user">
    <img class="avatar" src="{{ asset('images/pp_default.jpg') }}">
    <div>
      <h4>{{ $siswa->nama }}</h4>
      <p>{{ $siswa->kelas }} {{ $siswa->jurusan }}</p>
    </div>
  </div>
  <div class="menu-toggle" onclick="toggleMenu()">☰</div>
</header>

<div class="content">

<div class="search-box">
<input type="text" id="searchInput" placeholder="Cari makanan atau minuman..." onkeyup="searchMenu()">
</div>

<section class="menu" id="searchResult">
    @foreach($produk as $data)

    @php
      $kantinOffline = !$data->penjual->isOnline();
    @endphp

    <div class="menu-card {{ $kantinOffline ? 'offline' : '' }}">

    <img src="{{ asset('storage/' . $data->kategori->gambar) }}">
    <p>{{ $data->kategori->nama_produk }}</p>
    <p style="font-style: italic;">
        Kantin {{ $data->penjual->no_kantin }}
    </p>

    <div class="menu-footer">
        <span class="harga">
            Rp {{ number_format($data->harga, 0, ',', '.') }}
        </span>

        <form action="{{ route('keranjang.tambah') }}" method="POST">
    @csrf
    <input type="hidden" name="produk_id" value="{{ $data->id }}">
    <input type="hidden" name="qty" id="qty-input-{{ $data->id }}" value="1">

    <!-- Tombol Tambah Awal -->
    <button type="button"
            id="btn-tambah-{{ $data->id }}"
            onclick="showQty({{ $data->id }})" class="btn-tambah">
        Tambah
    </button>

     <!-- Box Qty (di bawah card) -->
        <div id="qty-box-{{ $data->id }}" class="qty-control" style="display:none; margin-top:8px; flex-direction:column; width:100%;">
    <!-- Baris Qty -->
            <div style="display:flex; gap:8px; justify-content:flex-start; margin-bottom:6px;">
                <button type="button" class="qty-btn" onclick="kurang({{ $data->id }})">-</button>
                <span id="qty-text-{{ $data->id }}" class="qty-number">1</span>
                <button type="button" class="qty-btn" onclick="tambah({{ $data->id }})">+</button>
            </div>

            <!-- Tombol Simpan -->
            <button type="button"
                    id="btn-tambah-{{ $data->id }}"
                    onclick="showQty({{ $data->id }})"
                    class="btn-tambah"
                    {{ $kantinOffline ? 'disabled style=background:#9ca3af;cursor:not-allowed;' : '' }}>
              Tambah
            </button>
        </div>

</form>



    </div>

</div>
@endforeach
</section>

</div>
</div>
</div>

<script>
function toggleMenu() {
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("overlay").classList.toggle("active");
}

// Menampilkan box qty ketika tombol "Tambah" diklik
function showQty(id) {
  document.getElementById('btn-tambah-' + id).style.display = 'none';
  document.getElementById('qty-box-' + id).style.display = 'flex';
}

// Fungsi tambah qty
function tambah(id) {
  let qtyText = document.getElementById('qty-text-' + id);
  let qtyInput = document.getElementById('qty-input-' + id);

  let value = parseInt(qtyText.innerText);
  value++;
  qtyText.innerText = value;
  qtyInput.value = value;

  updateKeranjang(id, value); // update ke DB
}

// Fungsi kurang qty
function kurang(id) {
  let qtyText = document.getElementById('qty-text-' + id);
  let qtyInput = document.getElementById('qty-input-' + id);
  let qtyBox = document.getElementById('qty-box-' + id);
  let btnTambah = document.getElementById('btn-tambah-' + id);

  let value = parseInt(qtyText.innerText);

  if (value > 1) {
    value--;
    qtyText.innerText = value;
    qtyInput.value = value;
    updateKeranjang(id, value); // update ke DB
  } else {
    // jika 1 dikurangi → 0 → sembunyikan box qty
    qtyText.innerText = 0;
    qtyInput.value = 0;
    qtyBox.style.display = 'none';
    btnTambah.style.display = 'inline-block';

    updateKeranjang(id, 0); // hapus dari DB
  }
}

// Fungsi AJAX untuk update qty ke backend
function updateKeranjang(id, qty) {
  fetch("{{ route('keranjang.update') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({ produk_id: id, qty: qty })
  })
  .then(res => res.json())
  .then(data => {
    console.log("Keranjang updated:", data);
    // kalau mau, update total harga di sini
  })
  .catch(err => console.error(err));
}

// Inisialisasi event untuk semua menu-card (termasuk yang muncul dari search)
function initCartLogic() {
  document.querySelectorAll(".menu-card").forEach(card => {
    const btnTambah = card.querySelector(".btn-tambah");
    const plusBtn = card.querySelector(".plus");
    const minusBtn = card.querySelector(".minus");

    if (btnTambah) {
      const id = btnTambah.id.split("-")[2];
      btnTambah.onclick = () => showQty(id);
    }
    if (plusBtn) {
      const id = plusBtn.closest(".menu-card").querySelector(".btn-tambah").id.split("-")[2];
      plusBtn.onclick = () => tambah(id);
    }
    if (minusBtn) {
      const id = minusBtn.closest(".menu-card").querySelector(".btn-tambah").id.split("-")[2];
      minusBtn.onclick = () => kurang(id);
    }
  });
}

// SEARCH FUNCTION
let timeout = null;
function searchMenu() {
  clearTimeout(timeout);

  timeout = setTimeout(() => {
    const keyword = document.getElementById("searchInput").value;

    fetch(`/search-produk?keyword=${keyword}`)
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("searchResult");
        container.innerHTML = "";

        if (data.length === 0) {
          container.innerHTML = "<p>Tidak ada menu ditemukan</p>";
          return;
        }

        data.forEach(item => {

  const isOffline = !(item.penjual && item.penjual.is_online);

          let gambar = item.kategori?.gambar
            ? `/storage/${item.kategori.gambar}`
            : "https://via.placeholder.com/300";

          container.innerHTML += `
            <div class="menu-card ${isOffline ? 'offline' : ''}">
              <img src="${gambar}">
              <p>${item.kategori.nama_produk}</p>
              <p style="font-style:italic;">Kantin ${item.penjual.no_kantin}</p>

              <div class="menu-footer">
                <span class="harga">Rp ${Number(item.harga).toLocaleString("id-ID")}</span>

                <form action="{{ route('keranjang.tambah') }}" method="POST">
                  @csrf
                  <input type="hidden" name="produk_id" value="${item.id}">
                  <input type="hidden" name="qty" id="qty-input-${item.id}" value="1">

                  <button type="button" id="btn-tambah-${item.id}" class="btn-tambah">Tambah</button>

                  <div id="qty-box-${item.id}" class="qty-control" style="display:none; margin-top:8px; flex-direction:column; width:100%;">
                    <div style="display:flex; gap:8px; justify-content:flex-start; margin-bottom:6px;">
                      <button type="button" class="qty-btn minus">-</button>
                      <span id="qty-text-${item.id}" class="qty-number">1</span>
                      <button type="button" class="qty-btn plus">+</button>
                    </div>
                    <button type="button"
                            id="btn-tambah-${item.id}"
                            class="btn-tambah"
                            ${isOffline ? 'disabled style="background:#9ca3af;cursor:not-allowed;"' : ''}>
                      Tambah
                    </button>
                  </div>
                </form>

              </div>
            </div>
          `;
        });

        initCartLogic(); // bind tombol baru
      });
  }, 400);
}

// Jalankan initCartLogic untuk card yang sudah ada di halaman awal
initCartLogic();

</script>


</body>
</html>
