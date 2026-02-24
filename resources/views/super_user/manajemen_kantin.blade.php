<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manajemen Kantin</title>

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

/* LAYOUT */
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

.sidebar ul li:hover{
    background:#334155;
}

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
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:25px;
}

.btn{
    padding:10px 16px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:14px;
}

.btn-primary{
    background:#1e293b;
    color:white;
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

/* MODAL */
.modal-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.5);
    display:none;
    z-index:999;
}

.modal{
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    background:white;
    padding:25px;
    border-radius:12px;
    width:350px;
    max-width:90%;
    display:none;
    z-index:1000;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.modal h2{
    margin-bottom:15px;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:5px;
    font-size:14px;
}

.form-group input{
    width:100%;
    padding:8px;
    border-radius:6px;
    border:1px solid #ccc;
}

.modal-buttons{
    display:flex;
    justify-content:flex-end;
    gap:10px;
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
        width:100%;
    }

    .main{
        padding:20px;
    }

    .header{
        gap:15px;
    }
}
</style>
</head>
<body>

<!-- OVERLAY -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal()"></div>

<!-- MODAL -->
<div class="modal" id="modalForm">
    <h2>Tambah Kantin</h2>

    <form action="{{ route('kantin.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" required>
        </div>

        <div class="form-group">
            <label>No Kantin</label>
            <input type="text" name="no_kantin" required>
        </div>

        <div class="modal-buttons">
            <button type="button" class="btn" onclick="closeModal()">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

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
    <div class="sidebar">
        <h2>SUPER USER</h2>
        <ul>
            <li>
                <a href="{{ route('super_user.index') }}">Dashboard</a>
            </li>

            <li class="active">
                <a href="">Manajemen Kantin</a>
            </li>

            <li>
                <a href="{{ route('super_user.siswa') }}">Siswa</a>
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

    <!-- MAIN -->
    <div class="main">

        <div class="header">
            <div>
                <h1>Manajemen Kantin</h1>
                <p>Status otomatis berdasarkan login pemilik</p>
            </div>
            <button class="btn btn-primary" onclick="openModal()">
                + Tambah Kantin
            </button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>No kantin</th>
                        <th>No HP</th>
                        <th>Status Login</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kantin as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>kantin {{ $data->no_kantin }}</td>
                        <td>{{ $data->no_hp }}</td>
                        <td>
                            @if($data->isOnline())
                                <span style="color: green; font-weight: 600;">Online</span>
                            @else
                                <span style="color: red; font-weight: 600;">Offline</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('kantin.destroy', $data->id) }}" 
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
function openModal(){
    document.getElementById("modalForm").style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

function closeModal(){
    document.getElementById("modalForm").style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
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
