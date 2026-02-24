<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Menu Kantin</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: 'Segoe UI', sans-serif;
}

body{
  background:#f1f5f9;
}

.container{
  max-width:1100px;
  margin:auto;
  padding:20px;
}

.card{
  background:white;
  padding:25px;
  border-radius:16px;
  box-shadow:0 8px 25px rgba(0,0,0,0.05);
}

h2{
  margin-bottom:20px;
}

.top-bar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:20px;
}

.btn-add{
  background:linear-gradient(135deg,#22c55e,#16a34a);
  color:white;
  padding:10px 18px;
  border-radius:12px;
  text-decoration:none;
  font-weight:600;
  display:inline-flex;
  align-items:center;
  gap:8px;
  transition:0.3s;
}

.btn-add:hover{
  transform:translateY(-2px);
  box-shadow:0 6px 18px rgba(0,0,0,0.15);
}

table{
  width:100%;
  border-collapse:collapse;
}

th{
  background:#f8fafc;
  text-align:left;
  padding:14px;
  font-size:14px;
  color:#64748b;
}

td{
  padding:14px;
  border-top:1px solid #e2e8f0;
  font-size:14px;
}

.badge{
  padding:6px 10px;
  border-radius:8px;
  font-size:12px;
  font-weight:600;
}

.badge-active{
  background:#dcfce7;
  color:#166534;
}

.badge-off{
  background:#fee2e2;
  color:#b91c1c;
}

.btn-delete{
  background:#ef4444;
  color:white;
  padding:6px 12px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  transition:0.3s;
}

.btn-delete:hover{
  opacity:0.8;
}

/* MOBILE MODE */
@media(max-width:768px){

  .top-bar{
    flex-direction:column;
    align-items:flex-start;
    gap:12px;
  }

  table, thead, tbody, th, td, tr{
    display:block;
    width:100%;
  }

  thead{
    display:none;
  }

  tr{
    background:white;
    padding:15px;
    border-radius:12px;
    margin-bottom:15px;
    box-shadow:0 4px 15px rgba(0,0,0,0.05);
  }

  td{
    display:flex;
    justify-content:space-between;
    padding:8px 0;
    border:none;
  }

  td::before{
    content:attr(data-label);
    font-weight:600;
    color:#475569;
  }

  .btn-delete{
    width:100%;
    margin-top:10px;
  }
}
</style>
</head>

<body>

<div class="container">
<div class="card">

<h2>📋 Daftar Menu Kantin</h2>

@if(session('success'))
  <p style="color:green;margin-bottom:15px;">
    {{ session('success') }}
  </p>
@endif

<div class="top-bar">
  <h3>Menu Kamu</h3>

  <a href="{{ route('tambah_menu') }}" class="btn-add">
    ➕ Tambah Menu
  </a>
</div>

<table>
<thead>
<tr>
<th>Nama Menu</th>
<th>Harga</th>
<th>Stok</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($produk as $item)
<tr>

<td data-label="Nama Menu">
{{ $item->kategori->nama_produk ?? '-' }}
</td>

<td data-label="Harga">
Rp {{ number_format($item->harga,0,',','.') }}
</td>

<td data-label="Stok">
{{ $item->stok }}
</td>

<td data-label="Status">
@if($item->stok > 0)
<span class="badge badge-active">Tersedia</span>
@else
<span class="badge badge-off">habis</span>
@endif
</td>

<td data-label="Aksi" style="display:flex; gap:8px; flex-wrap:wrap;">

  <!-- ✅ EDIT -->
  <a href="{{ route('kantin.menu.edit', $item->id) }}"
     style="background:#3b82f6;color:white;padding:6px 12px;border-radius:8px;text-decoration:none;font-size:13px;">
     Edit
  </a>

  <!-- ✅ DELETE -->
  <form action="{{ route('kantin.menu.delete',$item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="button"
      onclick="openEditModal(
        {{ $item->id }},
        '{{ $item->kategori->nama_produk ?? '-' }}',
        {{ $item->harga }},
        {{ $item->stok }}
      )"
      style="background:#3b82f6;color:white;padding:6px 12px;border:none;border-radius:8px;cursor:pointer;font-size:13px;">
      Edit
    </button>
  </form>

</td>

</tr>
@empty
<tr>
<td colspan="5">Belum ada menu</td>
</tr>
@endforelse
</tbody>

</table>

</div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="editModal" style="
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.45);
  display:none;
  align-items:center;
  justify-content:center;
  z-index:999;
">

  <div style="
    background:white;
    padding:25px;
    border-radius:16px;
    width:90%;
    max-width:420px;
    box-shadow:0 20px 40px rgba(0,0,0,0.25);
  ">

    <h3 style="margin-bottom:15px;">✏️ Edit Menu</h3>

    <form id="editForm" method="POST">
      @csrf
      @method('PUT')

      <p id="editNama" style="margin-bottom:10px;font-weight:600;"></p>

      <label>Harga</label>
      <input type="number" name="harga" id="editHarga"
        style="width:100%;padding:10px;margin-bottom:12px;border:1px solid #ddd;border-radius:8px;">

      <label>Stok</label>
      <input type="number" name="stok" id="editStok"
        style="width:100%;padding:10px;margin-bottom:18px;border:1px solid #ddd;border-radius:8px;">

      <div style="display:flex;gap:10px;">
        <button type="button" onclick="closeEditModal()"
          style="flex:1;padding:10px;border:none;border-radius:8px;background:#e5e7eb;cursor:pointer;">
          Batal
        </button>

        <button type="submit"
          style="flex:1;padding:10px;border:none;border-radius:8px;background:#22c55e;color:white;font-weight:600;cursor:pointer;">
          Simpan
        </button>
      </div>
    </form>

  </div>
</div>

<script>
function openEditModal(id, nama, harga, stok) {
  document.getElementById('editModal').style.display = 'flex';

  document.getElementById('editNama').innerText = nama;
  document.getElementById('editHarga').value = harga;
  document.getElementById('editStok').value = stok;

  // set action form
  document.getElementById('editForm').action =
    `/kantin/menu/update/${id}`;
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}

// klik background untuk tutup
document.getElementById('editModal').addEventListener('click', function(e){
  if(e.target === this){
    closeEditModal();
  }
});
</script>

</body>
</html>
