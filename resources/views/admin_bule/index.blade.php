<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Kantin</title>

<style>

/* ================= RESET ================= */
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

/* ================= LAYOUT ================= */
.app{
  display:flex;
  min-height:100vh;
}

/* ================= SIDEBAR ================= */
.sidebar{
  width:240px;
  background:#2f5f9f;
  color:white;
  padding:20px;
  transition:0.3s;
  box-shadow:4px 0 12px rgba(0,0,0,0.15);
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
  margin-bottom:6px;
  transition:0.2s;
}

.sidebar li.active{
  background:#3f6fb3;
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
}

/* ================= CONTENT ================= */
.content{
  flex:1;
  display:flex;
  flex-direction:column;
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
  border:2px solid white;
}

.menu-toggle{
  font-size:24px;
  cursor:pointer;
  display:none;
}

/* ================= ISI ================= */
.isi{
  padding:30px;
}

.admin-title{
  font-size:22px;
  font-weight:bold;
  margin-bottom:20px;
  color:#2f5f9f;
}

/* ================= TABLE DESKTOP ================= */
.order-table{
  background:white;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 6px 15px rgba(0,0,0,0.08);
}

.order-table table{
  width:100%;
  border-collapse:collapse;
}

.order-table th{
  background:#3f6fb3;
  color:white;
  padding:15px;
  text-align:left;
}

.order-table td{
  padding:15px;
  border-bottom:1px solid #eee;
  font-size:14px;
}

.order-table tr:last-child td{
  border-bottom:none;
}

/* ================= STATUS ================= */
.status-btn{
  padding:6px 12px;
  border-radius:8px;
  font-size:12px;
  color:white;
}

.status-proses{ background:#f0ad4e; }
.status-selesai{ background:#5cb85c; }

/* ================= BUTTON ================= */
.confirm-btn{
  background:#2f5f9f;
  color:white;
  border:none;
  padding:7px 14px;
  border-radius:8px;
  cursor:pointer;
  transition:0.2s;
}

.confirm-btn:hover{
  background:#244a7a;
}

/* ================= EMPTY ROW ================= */
.empty-row td{
  text-align:center;
  padding:40px !important;
  font-weight:500;
  color:#777;
  font-size:16px;
}

/* ================= OVERLAY ================= */
.overlay{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.4);
  display:none;
  z-index:90;
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

/* EMPTY CARD */
.empty-card{
    background:white;
    text-align:center;
    padding:40px;
    border-radius:12px;
    color:#777;
    font-size:16px;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
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

/* ================================================= */
/* ================= RESPONSIVE ===================== */
/* ================================================= */

@media(max-width:768px){

  .app{
    flex-direction:column;
  }

  .sidebar{
    position:fixed;
    left:-100%;
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

  .overlay.active{
    display:block;
  }

  .isi{
    padding:18px;
  }

  .admin-title{
    font-size:18px;
  }

  .order-table{
    background:transparent;
    box-shadow:none;
  }

  .order-table thead{
    display:none;
  }

  .order-table table,
  .order-table tbody,
  .order-table tr,
  .order-table td{
    display:block;
    width:100%;
  }

  .order-table tbody tr{
    background:white;
    padding:18px;
    border-radius:16px;
    margin-bottom:20px;
    box-shadow:0 6px 15px rgba(0,0,0,0.08);
  }

  .order-table tbody td{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    padding:8px 0;
    border:none;
    font-size:13px;
  }

  .order-table tbody td::before{
    content:attr(data-label);
    font-weight:600;
    color:#2f5f9f;
  }

  td[data-label="Menu"]{
    flex-direction:column;
    align-items:flex-start;
  }

  .confirm-btn{
    width:100%;
    margin-top:10px;
  }

  /* ===== EMPTY ROW FIX MOBILE ===== */
  .empty-row td{
    display:block !important;
    text-align:center !important;
    justify-content:center !important;
    align-items:center !important;
  }

  .empty-row td::before{
    display:none !important;
    content:none !important;
  }

}

</style>
</head>
<body>

<!-- POPUP KONFIRMASI -->
<div id="confirmPopup" class="popup-overlay">
  <div class="popup-box">
    <h3>Konfirmasi</h3>
    <p>Yakin pesanan sudah selesai?</p>

    <div class="popup-actions">
      <button class="btn-cancel" onclick="closeConfirmPopup()">Batal</button>
      <button class="btn-ok" onclick="submitProcess()">Ya, Selesai</button>
    </div>
  </div>
</div>

<!-- ===================================================== -->
<!-- ===================== OVERLAY ======================= -->
<!-- ===================================================== -->

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>


<!-- ===================================================== -->
<!-- ===================== MAIN APP ====================== -->
<!-- ===================================================== -->

<div class="app">


  <!-- ================= SIDEBAR ================= -->
  <aside class="sidebar" id="sidebar">
    <h2>KE-Kantin</h2>
    <ul>
      <li class="active"><a href=""><img src="{{ asset('images/home.png') }}"><span>Dashboard</span></a></li>
      <li><a href="{{ route('dashboard.riwayat') }}"><img src="{{ asset('images/riwayat.png') }}"><span>Riwayat</span></a></li>
      <li><a href="{{ route('tambah_menu') }}"><img src="{{ asset('images/tambah.png') }}"><span>Tambah Menu</span></a></li>
      <li><a href="{{ route('profile.kantin') }}"><img src="{{ asset('images/user.png') }}"><span>Profil</span></a></li>
    </ul>
  </aside>


  <!-- ================= CONTENT ================= -->
  <main class="content">


    <!-- ================= HEADER ================= -->
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

      <div class="admin-title">Order Masuk</div>

      

        <tbody>
<div class="order-cards">
@if($transaksi->isEmpty())
    <div class="empty-card">
        Belum ada order masuk
    </div>
@else
    @foreach($transaksi as $trx)
        <div class="card">
            <div class="card-header">
                <div class="card-no">#{{ $loop->iteration }}</div>
                <div class="card-status status-">
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

            <div class="card-footer">
                  <form action="{{ route('transaksi.proses', $trx->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                    <button type="button" class="confirm-btn"
                            onclick="openProcessPopup(this)">
                      Proses
                    </button>
                  </form>
            </div>
        </div>
    @endforeach
@endif
</div>

</tbody>


        </table>

    </div>

  </main>

</div>

<script>
function toggleMenu(){
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("overlay").classList.toggle("active");
}

let formToSubmit = null;

function openProcessPopup(btn){
  formToSubmit = btn.closest("form");
  document.getElementById("confirmPopup").classList.add("active");
}

function closeConfirmPopup(){
  document.getElementById("confirmPopup").classList.remove("active");
}

function submitProcess(){
  if(formToSubmit){
    formToSubmit.submit();
  }
}

async function loadOrders() {
    try {
        const container = document.querySelector(".order-cards");
        if (!container) return;

        const res = await fetch("{{ route('kantin.orderTerbaru') }}", {
            credentials: "same-origin",
            headers: {
                "Accept": "application/json"
            }
        });

        // 🚨 kalau bukan 200
        if (!res.ok) {
            console.warn("HTTP error:", res.status);
            return;
        }

        const text = await res.text();

        // 🚨 kalau ternyata HTML (misal redirect/login)
        if (text.startsWith("<")) {
            console.warn("Server kirim HTML, bukan JSON");
            return;
        }

        const data = JSON.parse(text);

        // ✅ kalau kosong
        if (!data.length) {
            container.innerHTML = `
                <div class="empty-card">
                    📦 Belum ada order masuk
                </div>
            `;
            return;
        }

        let html = "";

        data.forEach((trx, index) => {
      let menuList = "";

      trx.detail.forEach(item => {
          const namaProduk =
              item.produk?.kategori?.nama_produk ??
              item.produk?.nama ??
              "-";

          menuList += `<li>${namaProduk} x${item.jumlah}</li>`;
      });

      const statusClass = (trx.status || '').toLowerCase();

      const tanggal = trx.created_at
          ? new Date(trx.created_at).toLocaleString('id-ID', {
              day: '2-digit',
              month: '2-digit',
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit'
            })
          : '-';

      html += `
        <div class="card">
            <div class="card-header">
                <div class="card-no">#${index + 1}</div>
                <div class="card-status status-${trx.status}">
                    ${trx.status}
                </div>
            </div>

            <div class="card-body">
                <div class="card-item">
                    <strong>Nama:</strong> ${trx.siswa?.nama ?? '-'}
                </div>

                <div class="card-item">
                    <strong>Menu:</strong>
                    <ul>${menuList}</ul>
                </div>

                <div class="card-item">
                    <strong>Total:</strong>
                    Rp ${Number(trx.total_harga ?? 0).toLocaleString('id-ID')}
                </div>

                <div class="card-item">
                    <strong>Tanggal:</strong> ${trx.created_at ?? '-'}
                </div>
            </div>

            <div class="card-footer">
                <form action="/transaksi/${trx.id}/proses" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">
                    <button type="button" class="confirm-btn"
                            onclick="openProcessPopup(this)">
                      Proses
                    </button>
                </form>
            </div>
        </div>
        `;
  });

        container.innerHTML = html;

    } catch (e) {
        console.error("Gagal load order:", e);
    }
}

// 🚀 load pertama
loadOrders();

// 🔁 refresh tiap 5 detik (LEBIH WARAS)
setInterval(loadOrders, 5000);
</script>

</body>
</html>
