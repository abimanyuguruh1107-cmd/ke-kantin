<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang | KE-Kantin</title>
</head>

<style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

a {
  text-decoration: none;
  color: inherit;
}

body {
  background: #eef1f6;
}

.app {
  display: flex;
  min-height: 100vh;
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

/* CONTENT */
.content {
  flex: 1;
  background: #f5f7fb;
}

/* ================= HEADER ================= */

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

/* ================= ORDER CARDS ================= */
.order-cards{
    display:flex;
    flex-direction:column;
    gap:16px;
    padding:10px 0;
}

/* CARD BASE */
.card{
    background:white;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    overflow:hidden;
    display:flex;
    flex-direction:column;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

/* CARD HEADER */
.card-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 16px;
    background:#2f5f9f;
    color:white;
}

.card-no{
    font-weight:bold;
}

.card-status{
    padding:4px 10px;
    border-radius:8px;
    font-size:12px;
    text-transform:capitalize;
    font-weight:bold;
}

.status-pending{ background:#f0ad4e; }
.status-diproses{ background:#0275d8; }
.status-selesai{ background:#5cb85c; }

/* CARD BODY */
.card-body{
    padding:12px 16px;
    display:flex;
    flex-direction:column;
    gap:6px;
}

.card-item strong{
    color:#2f5f9f;
}

/* MENU LIST */
.card-item ul{
    list-style:none;
    padding-left:0;
    margin:0;
}

.card-item ul li{
    background:#eef1f6;
    margin:3px 0;
    padding:4px 8px;
    border-radius:6px;
    font-size:14px;
}

/* CARD FOOTER */
.card-footer{
    padding:12px 16px;
    display:flex;
    justify-content:flex-end;
    background:#f7f7f7;
}

.btn-proses{
    background:#2f5f9f;
    color:white;
    border:none;
    padding:8px 16px;
    border-radius:8px;
    cursor:pointer;
    transition:0.2s;
    font-weight:bold;
}

.btn-proses:hover{
    background:#244a7a;
}

.finished-text{
    color:#777;
    font-weight:bold;
}

/* CART LIST */
.cart {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.cart-item {
  background: white;
  border-radius: 12px;
  padding: 12px;
  display: flex;
  align-items: center;
  gap: 14px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.cart-item img {
  width: 70px;
  height: 70px;
  border-radius: 8px;
  object-fit: cover;
}

.cart-item .info {
  flex: 1;
}

.cart-item .info h4 {
  font-size: 14px;
}

.cart-item .info p {
  font-size: 12px;
  color: #666;
}

.qty-control {
    display: flex;
    align-items: center;
    gap: 8px;
}

.qty-btn {
    width: 28px;
    height: 28px;
    border: none;
    background: #2f5f9f;
    color: white;
    border-radius: 50%;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
}

.qty-btn:hover {
    background: #244a7a;
}

.qty-number {
    min-width: 24px;
    text-align: center;
    font-weight: bold;
}


.price {
  font-weight: bold;
  color: #2f5f9f;
}

/* SUMMARY */
.summary {
  padding: 20px;
  border-top: 1px solid #ddd;
  background: white;
}

.summary .row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 12px;
}

.checkout {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 10px;
  background: #2f5f9f;
  color: white;
  font-size: 15px;
  font-weight: bold;
  cursor: pointer;
}

.checkout:hover {
  background: #264f87;
}

/* ===== POPUP ===== */
.popup-overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.45);
  display:none;
  align-items:center;
  justify-content:center;
  z-index:9999;
}

.popup-overlay.active{
  display:flex;
}

.popup-box{
  background:white;
  padding:22px;
  border-radius:16px;
  width:90%;
  max-width:320px;
  text-align:center;
  animation:popupScale .18s ease;
}

@keyframes popupScale{
  from{
    transform:scale(0.85);
    opacity:0;
  }
  to{
    transform:scale(1);
    opacity:1;
  }
}

.popup-actions{
  display:flex;
  gap:10px;
  margin-top:16px;
}

.btn-cancel{
  flex:1;
  padding:8px;
  border:none;
  border-radius:8px;
  background:#e5e7eb;
  cursor:pointer;
}

.btn-ok{
  flex:1;
  padding:8px;
  border:none;
  border-radius:8px;
  background:#2f5f9f;
  color:white;
  cursor:pointer;
}
/* RESPONSIVE */
@media (max-width: 768px) {
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
}

</style>

<!-- POPUP KONFIRMASI -->
<div id="confirmPopup" class="popup-overlay">
  <div class="popup-box">
    <h3>Konfirmasi Checkout</h3>
    <p>Yakin ingin melanjutkan checkout?</p>

    <div class="popup-actions">
      <button class="btn-cancel" onclick="closeConfirmPopup()">Batal</button>
      <button class="btn-ok" onclick="submitCheckout()">Ya, Checkout</button>
    </div>
  </div>
</div>

<body>

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="app">

  <!-- SIDEBAR -->
 <aside class="sidebar" id="sidebar">
  <h2>KE-Kantin</h2>
  <ul>
    <li><a href="{{ route('index') }}"><img src="{{ asset('images/home.png') }}"><span>Home</span></a></li>
    <li><a href="{{ route('search') }}"><img src="{{ asset('images/search.png') }}"><span>Search</span></a></li>
    <li class="active"><a href="/keranjang"><img src="{{ asset('images/grocery-store.png') }}"><span>Keranjang</span></a></li>
    <li><a href="{{ route('profile_page') }}"><img src="{{ asset('images/user.png') }}"><span>Profil</span></a></li>
  </ul>
</aside>


  <!-- CONTENT -->
  <main class="content">

    <!-- HEADER -->
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

    <!-- LIST KERANJANG -->
    <section class="cart">

      @foreach($keranjang as $item)
<div class="cart-item">

    <img src="{{ asset('storage/' . $item->produk->kategori->gambar) }}" width="70">

    <div class="info">
        <h4>{{ $item->produk->kategori->nama_produk }}</h4>
        <p>{{ $item->produk->penjual->nama }}</p>
    </div>

    <div class="qty-control" id="qty-box-{{ $item->id }}">
        <button type="button" class="qty-btn" onclick="kurang({{ $item->id }})">-</button>
        <span id="qty-text-{{ $item->id }}" class="qty-number">{{ $item->qty }}</span>
        <button type="button" class="qty-btn" onclick="tambah({{ $item->id }})">+</button>
    </div>


    <div class="price">
        Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}
    </div>

</div>
@endforeach



    <!-- TOTAL -->
    <section class="summary">
        <div class="row">
          <span>Total</span>
          <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
        </div>

        <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="button" class="checkout" onclick="openConfirmPopup()">
              Checkout
            </button>
        </form>
      </section>

<div class="order-cards">
    @foreach($transaksi as $trx)
        <div class="card">
            <div class="card-header">
                <div class="card-no">#{{ $loop->iteration }}</div>
                <div class="card-status status-{{ $trx->status }}">
                    {{ ucfirst($trx->status) }}
                </div>
            </div>

            <div class="card-body">
                <div class="card-item">
                    <strong>Nama:</strong> {{ $trx->siswa->nama }}
                </div>

                <div class="card-item">
                    <strong>Menu:</strong>
                    <ul>
                        @foreach($trx->detail as $item)
                            <li>{{ $item->produk->kategori->nama_produk ?? $item->produk->nama }} x{{ $item->jumlah }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-item">
                    <strong>Total:</strong> Rp {{ number_format($trx->total_harga,0,',','.') }}
                </div>

                <div class="card-item">
                    <strong>Tanggal:</strong> {{ $trx->created_at->format('d-m-Y H:i') }}
                </div>
            </div>
        </div>
    @endforeach
</div>

  </main>
</div>

<script>
  function toggleMenu(){
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("overlay").classList.toggle("active");
}

function openConfirmPopup(){
  document.getElementById("confirmPopup").classList.add("active");
}

function closeConfirmPopup(){
  document.getElementById("confirmPopup").classList.remove("active");
}

function submitCheckout(){
  document.getElementById("checkoutForm").submit();
}

function tambah(id) {
    let qtyText = document.getElementById('qty-text-' + id);
    let value = parseInt(qtyText.innerText);
    value++;
    qtyText.innerText = value;

    updateKeranjang(id, value);
}

function kurang(id) {
    let qtyText = document.getElementById('qty-text-' + id);
    let cartItem = document.getElementById('qty-box-' + id).closest('.cart-item');

    let value = parseInt(qtyText.innerText);

    if (value > 1) {
        value--;
        qtyText.innerText = value;
        updateKeranjang(id, value);
    } else {
        // kalau sudah 1 lalu dikurangi → jadi 0, hapus dari DOM
        cartItem.remove();
        updateKeranjang(id, 0);
    }
}

// Fungsi ini untuk update ke backend via AJAX (opsional)
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
        console.log("Keranjang updated", data);
        // bisa update total harga di sini juga
    });
}
</script>

</body>
</html>
