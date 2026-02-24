<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar NIS</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background:#f4f6f9;
    padding:30px;
}

.header{
    margin-bottom:20px;
}

.btn-add{
    padding:8px 16px;
    background:#1e293b;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.btn-add:hover{
    opacity:0.9;
}

.table-container{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    margin-top:20px;
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
</style>
</head>
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

        <form action="{{ route('nis.store') }}" method="POST">
            @csrf

            <input type="text" name="nis" placeholder="NIS" required>
            <input type="text" name="nama" placeholder="Nama Siswa" required>

            <div class="modal-actions">
                <button type="submit">Simpan</button>
                <button type="button" onclick="closeModal()" class="cancel">Batal</button>
            </div>
        </form>
    </div>
</div>

<body>

<div class="header">
    <h1>Daftar NIS</h1>
    <p>Kelola data NIS siswa</p>

    <br>

    <button class="btn-add" onclick="openModal()">
        + Tambah Data
    </button>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Aksi</th>
                <th>Tanggal Ditambahkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nis as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nis }}</td>
                <td>{{ $data->nama }}</td>
                <td>
                    <form action="{{ route('nis.destroy', $data->id) }}" 
                        method="POST" 
                        class="form-delete">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-delete">
                            Hapus
                        </button>
                    </form>
                </td>
                <td>{{ $data->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function openModal(){
    document.getElementById("modal").classList.add("active");
}

function closeModal(){
    document.getElementById("modal").classList.remove("active");
}
</script>

</body>
</html>
