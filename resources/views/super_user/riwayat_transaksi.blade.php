<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Pembelian - Super User</title>

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

/* FILTER */
.filter-box{
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:25px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    display:flex;
    gap:15px;
    flex-wrap:wrap;
    align-items:center;
}

.filter-box input,
.filter-box select{
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
    min-width:900px;
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

.status.success{
    background:#dcfce7;
    color:#15803d;
}

.status.refund{
    background:#fee2e2;
    color:#b91c1c;
}

/* TOGGLE */
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

    .filter-box{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-box input,
    .filter-box select,
    .filter-box button{
        width:100%;
    }
}
</style>
</head>

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

            <li class="active">
                <a href="">Riwayat Semua Pembelian</a>
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
            <h1>Riwayat Pembelian</h1>
            <p>Data lengkap seluruh transaksi siswa</p>
        </div>

        <!-- FILTER -->
        <div class="filter-box">
           <input type="text" id="searchInput" placeholder="Cari nama / NIS...">
        </div>

        <!-- TABLE -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Kantin</th>
                        <th>Menu</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $key => $t)
                    <tr class="row-data">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $t->created_at->format('d-m-Y') }}</td>
                        <td>{{ $t->siswa->nama }}</td>

                        <td>
                            {{ $t->detail->pluck('produk.penjual.nama')->unique()->implode(', ') }}
                        </td>

                        <td>
                            {{ $t->detail->pluck('produk.kategori.nama_produk')->implode(', ') }}
                        </td>

                        <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td><span class="status success">Berhasil</span></td>
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

document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('.row-data');

    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();

        if (text.indexOf(keyword) > -1) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

</body>
</html>
