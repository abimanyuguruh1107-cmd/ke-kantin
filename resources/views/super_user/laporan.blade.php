<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan - Super User</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    display:flex;
    background:#f4f6f9;
}

/* ================= SIDEBAR ================= */
.sidebar{
    width:250px;
    min-height:100vh;
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
    transition:0.3s;
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

/* ================= MAIN ================= */
.main{
    flex:1;
    padding:30px;
}

/* Header */
.header{
    margin-bottom:30px;
}

/* ================= FILTER ================= */
.filter-box{
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:25px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    display:flex;
    gap:15px;
    align-items:center;
    flex-wrap:wrap;
}

.filter-box input{
    padding:8px 12px;
    border-radius:6px;
    border:1px solid #ccc;
}

.filter-box button{
    padding:8px 16px;
    border:none;
    border-radius:6px;
    background:#1e293b;
    color:white;
    cursor:pointer;
}

.filter-box button:hover{
    opacity:0.9;
}

/* ================= SUMMARY ================= */
.summary{
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:25px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

.summary h2{
    margin-bottom:10px;
}

/* ================= TABLE ================= */
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
    min-width:600px;
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

/* ================= MOBILE ================= */
.menu-toggle{
    display:none;
    background:#1e293b;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:6px;
    margin-bottom:15px;
}

    
        /* OVERLAY */
        .overlay{
            display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.4);
            z-index:999;
        }
    
        .overlay.active{
            display:block;
        }
@media(max-width:768px){

    body{
        flex-direction:column;
    }

    .sidebar{
        position:fixed;
        left:-260px;
        top:0;
        width:250px;
        height:100%;
        z-index:1000;
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

    .filter-box{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-box input,
    .filter-box button{
        width:100%;
    }
}

</style>
</head>

<body>

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

            <li class="active">
                <a href="">Laporan</a>
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
        <h1>Laporan Pendapatan</h1>
        <p>Rekap pendapatan semua kantin</p>
    </div>

    <!-- FILTER -->
    <div class="filter-box">
        <label>Dari:</label>
        <input type="date">
        <label>Sampai:</label>
        <input type="date">
        <button>Filter</button>
        <button style="background:green;">Export Excel</button>
        <button style="background:#dc2626;">Export PDF</button>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        <h2>Total Pendapatan Periode Ini</h2>
        <h1 style="color:#1e293b;">Rp 12.450.000</h1>
    </div>

    <!-- TABLE -->
    <div class="table-container">
        <h2 style="margin-bottom:15px;">Detail Laporan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kantin</th>
                    <th>Total Transaksi</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Kantin Bu Sari</td>
                    <td>45</td>
                    <td>Rp 3.500.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kantin Pak Budi</td>
                    <td>38</td>
                    <td>Rp 2.900.000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Kantin Sehat</td>
                    <td>52</td>
                    <td>Rp 4.200.000</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Kantin Modern</td>
                    <td>29</td>
                    <td>Rp 1.850.000</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
        document.getElementById("overlay").classList.toggle("active");
    }

    function closeSidebar() {
        document.getElementById("sidebar").classList.remove("active");
        document.getElementById("overlay").classList.remove("active");
    }
</script>

</body>
</html>
