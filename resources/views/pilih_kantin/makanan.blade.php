<!DOCTYPE html>
<html lang="id">
<head>

<!-- ================= META ================= -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>main</title>

<style>

/* ================================================= */
/* ================= 1. GLOBAL ===================== */
/* ================================================= */

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Arial, sans-serif;
}

body{
  background:#eef1f6;
}

a{
  text-decoration:none;
  color:inherit;
}


/* ================================================= */
/* ================= 2. LAYOUT ===================== */
/* ================================================= */

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

  position: fixed;   /* ⭐ penting */
  top: 0;
  left: 0;
  height: 100vh;
  z-index: 100;
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

/* ================================================= */
/* ================= 4. CONTENT ==================== */
/* ================================================= */

.content{
  flex:1;
  background:#f5f7fb;
  overflow-x:hidden;
  padding-bottom:120px;

  margin-left:240px;
  padding-top:80px;
}


/* ================= HEADER ================= */

.header{
  background:#2f5f9f;
  padding:0 25px;        /* ubah */
  height:80px;           /* ⭐ tinggi pasti */
  color:white;
  display:flex;
  justify-content:space-between;
  align-items:center;

  position: fixed;
  top: 0;
  left: 240px;
  right: 0;
  z-index: 100;
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


/* ================================================= */
/* ================= 5. KANTIN ===================== */
/* ================================================= */

.kantin{
  display:flex;
  gap:20px;
  padding:20px;
  width:100%;
  overflow-x:auto;
  overflow-y:hidden;
  scrollbar-width:none;
}

.kantin::-webkit-scrollbar{
  display:none;
}

.kantin-card{
  width:100%;
  height:90px;
  flex-shrink:0;
  background:linear-gradient(#7fa6d8, #3f6fb3);
  color:white;
  border-radius:14px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:bold;
  transition:transform 0.2s ease, box-shadow 0.2s ease;
}

.kantin-card:hover{
  transform:translateY(-4px);
  box-shadow:0 6px 14px rgba(0,0,0,0.15);
}


/* ================================================= */
/* ================= 6. KATEGORI =================== */
/* ================================================= */

.kategori{
  display:flex;
  gap:10px;
  padding:0 20px 10px;
}

.kategori button{
  padding:8px 18px;
  border-radius:20px;
  border:none;
  background:#dbe2ef;
  cursor:pointer;
  transition:background 0.2s ease, transform 0.2s ease;
}

.kategori button:hover{
  background:#cfd8ea;
  transform:translateY(-2px);
}

.kategori .active{
  background:#2f5f9f;
  color:white;
}


/* ================================================= */
/* ================= 7. MENU GRID ================== */
/* ================================================= */

.menu{
  display:grid;
  grid-template-columns:repeat(4, 1fr);
  gap:20px;
  padding:20px;
}

.menu-card{
  background:white;
  border-radius:14px;
  padding:10px;
  box-shadow:0 4px 10px rgba(0,0,0,0.08);
  transition:transform 0.2s ease, box-shadow 0.2s ease;
  cursor:pointer;
}

.menu-card:hover{
  transform:translateY(-4px);
  box-shadow:0 6px 14px rgba(0,0,0,0.15);
}

.menu-card img{
  width:100%;
  height:110px;
  object-fit:cover;
  border-radius:10px;
  margin-bottom:8px;
}

.menu-card p{
  font-size:13px;
}


/* ================= QTY ================= */

.menu-footer{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-top:10px;
}

.harga{
  font-weight:bold;
}

.btn-tambah{
  background:#2f5f9f;
  color:white;
  border:none;
  padding:6px 12px;
  border-radius:6px;
  cursor:pointer;
  font-size:13px;
}

/* ================= QTY ================= */
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


.overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.4);
  display:none;
  z-index:98;
}

.overlay.active{
  display:block;
}

/* ================= FLOATING CART ================= */
.fab-cart{
  position:fixed;
  bottom:20px;
  right:20px;
  width:60px;
  height:60px;
  background:#2f5f9f;
  color:white;
  border-radius:50%;
  display:none; /* ❗ default sembunyi */
  align-items:center;
  justify-content:center;
  font-size:26px;
  box-shadow:0 6px 18px rgba(0,0,0,0.25);
  z-index:120;
  transition:0.2s;
}

.fab-cart img{
  width:28px;
  height:28px;
}

@media (max-width:768px){

    /* ===== SIDEBAR MOBILE ===== */
  .sidebar{
    position:fixed;
    left:-250px;
    top:0;
    height:100%;
    z-index:101;
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

  .menu{
    grid-template-columns:repeat(2, 1fr);
    padding-bottom:90px;
  }

  .kantin-card{
    width:100%;
  }

  .btn-tambah{
    padding:4px 6px;
  }

  .fab-cart{
    display:flex;
  }

  .header{
    left:0;
    right:0;
    width:100%;
  }

  .content{
    margin-left:0;
  }
}

</style>
</head>

<a href="{{ route('keranjang.index') }}" class="fab-cart">
  <img src="{{ asset('images/grocery-store.png') }}" alt="Keranjang">
</a>


<body>

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="app">

  <!-- ================= SIDEBAR ================= -->
  <aside class="sidebar" id="sidebar">
    <h2>KE-Kantin</h2>
    <ul>
      <li class="active"><a href="{{ route('index') }}"><img src="{{ asset('images/home.png') }}"><span>Home</span></a></li>
      <li><a href="{{ route('search') }}"><img src="{{ asset('images/search.png') }}"><span>Search</span></a></li>
      <li><a href="{{ route('keranjang.index') }}"><img src="{{ asset('images/grocery-store.png') }}"><span>Keranjang</span></a></li>
      <li><a href="{{ route('profile_page') }}"><img src="{{ asset('images/user.png') }}"><span>Profil</span></a></li>
    </ul>
  </aside>

  <!-- ================= CONTENT ================= -->
  <main class="content">

    <!-- ================= HEADER ================= -->
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

    <section class="kantin">
        <a href="" class="kantin-card">KANTIN {{ $kantin->no_kantin }}</a>
    </section>


      <section class="kategori">
        <a href="{{ route('pilih_kantin', ['id' => $kantin->id]) }}"><button>Semua</button></a>
        <a href="{{ route('kantin.makanan', ['id' => $kantin->id]) }}"><button class="active">Makanan</button></a>
        <a href="{{ route('kantin.minuman', ['id' => $kantin->id]) }}"><button>Minuman</button></a>
      </section>

      <section class="menu">
@foreach($produk as $data)
<div class="menu-card">

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
            <button type="submit" class="btn-tambah" style="width:100%; padding:6px 0;">Simpan</button>
        </div>

</form>



    </div>

</div>
@endforeach
</section>


  </main>
</div>

<!-- ================= SCRIPT ================= -->
<script>
/* ===== TOGGLE SIDEBAR ===== */
function toggleMenu(){
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
</script>


</body>
</html>
