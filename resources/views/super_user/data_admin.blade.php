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

/* MODAL */
.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.4);
    justify-content:center;
    align-items:center;
    z-index:1000;
}

.modal.active{
    display:flex;
}

.modal-content{
    background:white;
    padding:25px;
    border-radius:12px;
    width:350px;
    max-width:90%;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.modal-content h3{
    margin-bottom:15px;
}

.modal-content input{
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border-radius:6px;
    border:1px solid #ccc;
}

.modal-actions{
    display:flex;
    justify-content:flex-end;
    gap:10px;
}

.modal-actions .cancel{
    background:#ccc;
    color:black;
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

<!-- MODAL TAMBAH ADMIN -->
<div class="modal" id="modal">
    <div class="modal-content">
        <h3>Tambah Admin</h3>

        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div style="color:red; margin-bottom:10px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <input type="text" name="nama" placeholder="Nama Admin" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="modal-actions">
                <button type="submit">Simpan</button>
                <button type="button" onclick="closeModal()" class="cancel">Batal</button>
            </div>
        </form>
    </div>
</div>



<body>

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

            <li class="active">
                <a href="">Daftar admin</a>
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
            <h1>Manajemen Admin</h1>
            <p>Kelola seluruh data Admin yang terdaftar</p>
        </div>

        <!-- ACTION BAR -->
        <div class="action-bar">
            <button onclick="openModal()">+ Tambah Admin</button>
        </div>

        <!-- TABLE -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admin as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>****</td>
                        <td>
                            <form action="{{ route('admin.destroy', $data->id) }}" 
                                method="POST" 
                                class="form-delete">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
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

function openModal(){
    document.getElementById("modal").classList.add("active");
}

function closeModal(){
    document.getElementById("modal").classList.remove("active");
}

</script>

</body>
</html>
