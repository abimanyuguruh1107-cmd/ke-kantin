<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Siswa - Super User</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:#f4f6f9;
}

.app{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    background:#1e293b;
    color:white;
    padding:20px;
    transition:0.3s;
}

.sidebar h2{
    margin-bottom:30px;
}

.sidebar ul{
    list-style:none;
}

.sidebar ul li{
    padding:12px;
    margin-bottom:10px;
    border-radius:8px;
    cursor:pointer;
}

.sidebar ul li:hover,
.sidebar ul li.active{
    background:#334155;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
    width: 100%;
}

.sidebar ul li a:hover {
    color: white;
}

/* MAIN */
.main{
    flex:1;
    padding:30px;
}

/* HEADER */
.header{
    margin-bottom:25px;
}

/* ACTION BAR */
.action-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
}

.action-bar input{
    padding:8px 12px;
    border-radius:6px;
    border:1px solid #ccc;
}

.action-bar button{
    padding:8px 16px;
    border:none;
    border-radius:6px;
    background:#1e293b;
    color:white;
    cursor:pointer;
}

.action-bar button:hover{
    opacity:0.9;
}

/* TABLE */
.table-container{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:700px;
}

thead{
    background:#1e293b;
    color:white;
}

th, td{
    padding:12px;
    text-align:left;
}

tbody tr:nth-child(even){
    background:#f1f5f9;
}

.status{
    padding:4px 10px;
    border-radius:6px;
    font-size:12px;
    font-weight:600;
}

.status.active{
    background:#dcfce7;
    color:#15803d;
}

.status.inactive{
    background:#fee2e2;
    color:#b91c1c;
}

/* TOGGLE BUTTON */
.menu-toggle{
    display:none;
    background:#1e293b;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:6px;
    margin-bottom:15px;
    cursor:pointer;
}

/* OVERLAY */
.overlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.4);
    z-index:998;
}

.overlay.active{
    display:block;
}
.btn-delete{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    background:#dc2626;
    color:white;
    cursor:pointer;
    font-size:13px;
}

.btn-delete:hover{
    opacity:0.85;
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

/* MOBILE */
@media(max-width:768px){

    .app{
        flex-direction:column;
    }

    .sidebar{
        position:fixed;
        left:-260px;
        top:0;
        height:100%;
        z-index:999;
    }

    .sidebar.active{
        left:0;
    }

    .menu-toggle{
        display:inline-block;
    }

    .main{
        padding:20px;
    }

    .action-bar{
        flex-direction:column;
        align-items:flex-start;
    }

    .action-bar input,
    .action-bar button{
        width:100%;
    }
}
</style>
</head>

<body>

<!-- POPUP KONFIRMASI -->
<div id="confirmPopup" class="popup-overlay">
  <div class="popup-box">
    <h3>Konfirmasi Hapus</h3>
    <p>Yakin ingin melanjutkan hapus?</p>

    <div class="popup-actions">
      <button class="btn-cancel" onclick="closeConfirmPopup()">Batal</button>
      <button class="btn-ok" onclick="submitCheckout()">Ya, Hapus</button>
    </div>
  </div>
</div>  

<div class="app">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <h2>SUPER USER</h2>
        <ul>
            <li>
                <a href="{{ route('super_user.index') }}">Dashboard</a>
            </li>

            <li>
                <a href="{{ route('super_user.manajemen_kantin') }}">Manajemen Kantin</a>
            </li>

            <li class="active">
                <a href="">Siswa</a>
            </li>

            <li>
                <a href="{{ route('super_user.produk') }}">Produk</a>
            </li>

            <li>
                <a href="{{ route('super_user.riwayat_transaksi') }}">Riwayat Semua Pembelian</a>
            </li>

            <li>
                <a href="{{ route('super_user.laporan') }}">Laporan</a>
            </li>

            <li>
                <a href="{{ route('super_user.data_admin') }}">Daftar admin</a>
            </li>

            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="all:unset; cursor:pointer; width:100%;">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- OVERLAY -->
    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <!-- MAIN -->
    <div class="main">

        <button class="menu-toggle" onclick="toggleSidebar()">☰ Menu</button>

        <div class="header">
            <h1>Manajemen Siswa</h1>
            <p>Kelola seluruh data siswa yang terdaftar</p>
        </div>

        <!-- ACTION BAR -->
        <div class="action-bar">
            <input type="text" id="searchInput" placeholder="Cari nama atau NIS...">
            
            <a href="{{ route('daftar_nis') }}">
                <button type="button">Daftar NIS</button>
            </a>

        </div>
        

        <!-- TABLE -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->nis }}</td>
                        <td>{{ $data->kelas }} {{ $data->jurusan }}</td>
                        <td>
                            <form action="{{ route('siswa.destroy', $data->id) }}" 
                                method="POST" 
                                class="form-delete">

                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn-delete"
                                        onclick="confirmDelete(this)">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("active");
    document.getElementById("overlay").classList.toggle("active");
}

function closeSidebar(){
    document.getElementById("sidebar").classList.remove("active");
    document.getElementById("overlay").classList.remove("active");
}

document.addEventListener("DOMContentLoaded", function() {

    const forms = document.querySelectorAll(".form-delete");

    forms.forEach(function(form) {
        form.addEventListener("submit", function(e) {

            let confirmDelete = confirm("Yakin ingin menghapus data ini?");

            if (!confirmDelete) {
                e.preventDefault(); // Batalkan submit
            }

        });
    });

});

document.addEventListener("DOMContentLoaded", function() {

    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function() {

        let keyword = searchInput.value.toLowerCase();

        tableRows.forEach(function(row) {

            let nama = row.children[1].textContent.toLowerCase();
            let nis  = row.children[2].textContent.toLowerCase();

            if (nama.includes(keyword) || nis.includes(keyword)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }

        });

    });

});

function openConfirmPopup(){
  document.getElementById("confirmPopup").classList.add("active");
}

function closeConfirmPopup(){
  document.getElementById("confirmPopup").classList.remove("active");
}

function submitCheckout(){
  document.getElementById("checkoutForm").submit();
}

let formToSubmit = null;

function confirmDelete(btn){
  formToSubmit = btn.closest("form");
  openConfirmPopup();
}

function submitCheckout(){
  if(formToSubmit) formToSubmit.submit();
}
</script>

</body>
</html>
