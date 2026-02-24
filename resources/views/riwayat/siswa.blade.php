<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Pembelian</title>

<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body{
  background: #f4f6f9;
}

/* ===== CONTAINER ===== */
.history-container{
  max-width: 1000px;
  margin: auto;
  padding-bottom: 40px;
}

/* ===== HEADER ===== */
.history-header{
  background: linear-gradient(#7fa6d8, #3f6fb3);
  padding: 25px;
  margin: 20px;
  border-radius: 15px;
  color: white;
}

.history-header h2{
  margin-bottom: 5px;
}

/* ===== CARD ===== */
.history-card{
  background: white;
  margin: 20px;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

/* ===== ITEM ===== */
.history-item{
  border-bottom: 1px solid #eee;
  padding: 15px 0;
}

.history-item:last-child{
  border-bottom: none;
}

.history-top{
  display: flex;
  justify-content: space-between;
  font-weight: bold;
  margin-bottom: 8px;
}

.history-detail{
  font-size: 14px;
  color: #555;
}

.history-detail span{
  display: block;
  margin: 2px 0;
}

/* ===== TOTAL BADGE ===== */
.total-badge{
  background: #2f5f9f;
  color: white;
  padding: 5px 10px;
  border-radius: 8px;
  font-size: 13px;
}

/* ===== EMPTY STATE ===== */
.empty-history{
  text-align: center;
  padding: 40px 20px;
  color: #777;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px){

  .history-top{
    flex-direction: column;
    gap: 5px;
  }

  .history-header{
    margin: 15px;
  }

  .history-card{
    margin: 15px;
  }

}
</style>
</head>

<body>

<div class="history-container">

  <!-- HEADER -->
  <div class="history-header">
    <h2>Riwayat Pembelian</h2>
    <p>Daftar pembelian yang telah dilakukan</p>
  </div>

  <!-- CARD -->
  <div class="history-card">

    <!-- ITEM 1 -->
    @foreach($transaksi as $t)
    @foreach($t->detail as $item)
    <div class="history-item">
        <div class="history-top">
            <div>{{ $item->produk->kategori->nama_produk }}</div>
            <div class="total-badge">
                Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
            </div>
        </div>
        <div class="history-detail">
            <span>Jumlah: {{ $item->jumlah }}</span>
            <span>Kantin: {{ $item->produk->penjual->nama }}</span>
            <span>Tanggal: {{ $t->created_at->format('d F Y') }}</span>
            <span>
                Status:
                <span
                    style="color: {{ $t->status == 'pending' ? '#ffc107' : ($t->status == 'selesai' ? '#28a745' : '#6c757d') }}; display:inline;"
                >
                    {{ ucfirst($t->status) }}
                </span>
            </span>
        </div>
    </div>
    @endforeach
@endforeach


  </div>

</div>

</body>
</html>
