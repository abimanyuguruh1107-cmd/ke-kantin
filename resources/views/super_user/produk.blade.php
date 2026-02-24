<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manajemen Produk</title>

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

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.btn{
    padding:8px 14px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:14px;
}

.btn-primary{
    background:#1e293b;
    color:white;
}

/* TAB */
.tab-buttons{
    margin-bottom:20px;
}

.tab-buttons button{
    margin-right:10px;
}

/* TABLE */
.table-container{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
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

.img-produk{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:8px;
}


.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.4);
    justify-content:center;
    align-items:center;
    z-index:1000;
}

.modal-content{
    background:white;
    padding:25px;
    border-radius:12px;
    width:350px;
    max-width:90%;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
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

</style>
</head>

<!-- MODAL TAMBAH KATEGORI -->
<div class="modal" id="modalForm">
    <div class="modal-content">
        <h2>Tambah Kategori</h2>
        <br>

        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:10px;">
                <label>Nama Kategori</label>
                <input type="text" name="nama_produk" style="width:100%; padding:8px;">
            </div>

            <div style="margin-bottom:15px;">
                <label>Jenis</label>
                <select name="jenis" style="width:100%; padding:8px;">
                    <option>Makanan</option>
                    <option>Minuman</option>
                </select>
            </div>

            <div style="margin-bottom:10px;">
                <label>Gambar</label>
                <input type="file" name="gambar" style="width:100%; padding:8px;">
            </div>

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" onclick="closeModal()">Batal</button>
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>


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
    <div class="sidebar">
        <h2>SUPER USER</h2>
        <ul>
            <li>
                <a href="{{ route('super_user.index') }}">Dashboard</a>
            </li>

            <li>
                <a href="{{ route('super_user.manajemen_kantin') }}">Manajemen Kantin</a>
            </li>

            <li>
                <a href="{{ route('super_user.siswa') }}">Siswa</a>
            </li>

            <li class="active">
                <a href="">Produk</a>
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
                <h1>Manajemen Produk</h1>
                <p>Kelola Produk & Kategori</p>
            </div>

            <button id="btnTambahKategori" 
                    class="btn btn-primary" 
                    onclick="openModal()" 
                    style="display:none;">
                + Tambah Kategori
            </button>
        </div>

        <!-- TAB BUTTON -->
        <div class="tab-buttons">
            <button class="btn btn-primary" onclick="showProduk()">Data Produk</button>
            <button class="btn btn-primary" onclick="showKategori()">Data Kategori</button>
        </div>

        <div class="table-container">

            <!-- ================= PRODUK ================= -->
            <div id="produkSection">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Kantin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->kategori->nama_produk }}</td>
                            <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                            <td>{{ $data->stok }}</td>
                            <td>kantin {{ $data->penjual->no_kantin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- ================= KATEGORI ================= -->
            <div id="kategoriSection" style="display:none;">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Jenis</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->nama_produk }}</td>
                            <td>{{ $data->jenis }}</td>
                            <td><img src="{{ asset('storage/'.$data->gambar) }}" class="img-produk" alt=""></td>
                            <td>
                                <form action="{{ route('kategori.destroy', $data->id) }}" 
                                method="POST" 
                                class="form-delete">

                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn-delete"
                                        onclick="confirmDelete(this)">
                                    Hapus
                                </button>
                            </form></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<script>
function showProduk(){
    document.getElementById("produkSection").style.display = "block";
    document.getElementById("kategoriSection").style.display = "none";
    document.getElementById("btnTambahKategori").style.display = "none";
}

function showKategori(){
    document.getElementById("produkSection").style.display = "none";
    document.getElementById("kategoriSection").style.display = "block";
    document.getElementById("btnTambahKategori").style.display = "inline-block";
}

function openModal(){
    document.getElementById("modalForm").style.display="flex";
}

function closeModal(){
    document.getElementById("modalForm").style.display="none";
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
