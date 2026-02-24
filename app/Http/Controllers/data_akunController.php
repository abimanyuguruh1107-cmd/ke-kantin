<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\siswa;
use App\Models\nis;
use App\Models\admin;
use App\Models\penjual;
use App\Models\Kategori;
use App\Models\produk;
use App\Models\keranjang;
use App\Models\transaksi;
use App\Models\detail;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class data_akunController extends Controller
{
    //fungsi menambahkan akun siswa
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'password' => 'required|confirmed',
            'kelas' => 'required',
            'jurusan' => 'required',
        ], [
            'password.confirmed' => 'Password harus sesuai',
        ]);

        // 1️⃣ Cek apakah NIS ada di tabel nis
        $cekNis = Nis::where('nis', $request->nis)->first();

        if (!$cekNis) {
            return back()->with('error', 'NIS tidak terdaftar!');
        }

        // 2️⃣ Cek apakah sudah pernah daftar
        $sudahDaftar = Siswa::where('nis', $request->nis)->first();

        if ($sudahDaftar) {
            return back()->with('error', 'NIS sudah pernah digunakan!');
        }

        // 3️⃣ Simpan ke tabel siswa
        Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil!');
    }

    //fungsi login siswa
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        // Cari siswa berdasarkan nama
        $siswa = Siswa::where('nama', $request->nama)->first();

        // Cek apakah ada dan password cocok
        if (!$siswa || !Hash::check($request->password, $siswa->password)) {
            return back()->with('error', 'Nama atau password salah!');
        }

        // Simpan session login
        session([
            'siswa_id' => $siswa->id,
            'siswa_nama' => $siswa->nama,
        ]);

        return redirect('/pilih-menu');
    }

    //fungsi hapus siswa
    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    //fungsi tambah nis
    public function storeNis(Request $request)
    {
        // Validasi
        $request->validate([
            'nis' => 'required|unique:nis,nis',
            'nama' => 'required'
        ]);

        // Simpan ke database
        nis::create([
            'nis' => $request->nis,
            'nama' => $request->nama
        ]);

        // Redirect kembali ke halaman daftar NIS
        return redirect()
            ->route('daftar_nis')
            ->with('success', 'Data NIS berhasil ditambahkan');
    }

    //fungsi hapus nis
    public function destroyNis($id)
    {
        nis::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    //fungsi tambah kantin
    public function storeKantin(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'no_hp' => 'required',
            'no_kantin' => 'required'
        ]);

        penjual::create([
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'no_kantin' => $request->no_kantin,
        ]);

        return redirect()->back()->with('success', 'Kantin berhasil ditambahkan');
    }

    //fungsi login kantin
    public function loginKantin(Request $request)
    {
        $penjual = Penjual::where('nama', $request->nama)->first();

        if (!$penjual || !Hash::check($request->password, $penjual->password)) {
            return back()->with('error', 'Nama atau password salah!');
        }

        // 🔥 update last seen saat login
        $penjual->last_seen = now();
        $penjual->save();

        session([
            'kantin_id' => $penjual->id,
            'kantin_nama' => $penjual->nama,
        ]);

        return redirect('/dashboard-kantin');
    }

    //fungsi hapus kantin
    public function destroyKantin($id)
    {
        $penjual = penjual::findOrFail($id);

        // 🔥 putus relasi transaksi dulu
        Transaksi::where('id_penjual', $id)
            ->update(['id_penjual' => null]);

        // hapus detail transaksi produk
        foreach ($penjual->produk as $produk) {
            $produk->detail_transaksi()->delete();
        }

        // hapus produk
        $penjual->produk()->delete();

        // hapus penjual
        $penjual->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    //fungsi tambah admin
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:admin,nama',
            'password' => 'required'
        ]);

        Admin::create([
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Admin berhasil ditambahkan');
    }

    //fungsi login admin
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('nama', $request->nama)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Nama atau password admin salah!');
        }

        // Simpan session admin
        session([
            'admin_id' => $admin->id,
            'admin_nama' => $admin->nama,
        ]);

        return redirect()->route('super_user.index');
    }

    //fungsi hapus admin
    public function destroyAdmin($id)
    {
        admin::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    //tambah kategori produk
    public function storekategori(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'jenis' => 'required',
        ]);

        $path = null;

        if($request->hasFile('gambar')){
            $path = $request->file('gambar')->store('kategori','public');
        }

        Kategori::create([
            'nama_produk' => $request->nama_produk,
            'jenis' => $request->jenis,
            'gambar' => $path
        ]);

        return redirect()->back()->with('success','Berhasil ditambahkan');
    }

    //hapus kategori
    public function destroykategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Hapus file gambar jika ada
        if($kategori->gambar && Storage::disk('public')->exists($kategori->gambar)){
            Storage::disk('public')->delete($kategori->gambar);
        }

        // Hapus data dari database
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    //funsgi tambah produk
    public function storeproduk(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        Produk::create([
            'id_penjual' => session('kantin_id'),
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);


        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function updateProduk(Request $request, $id)
{
    // ✅ validasi
    $request->validate([
        'harga' => 'required|numeric|min:0',
        'stok'  => 'required|integer|min:0',
    ]);

    // ✅ ambil produk
    $produk = Produk::findOrFail($id);

    // ⚠️ OPTIONAL tapi SANGAT DISARANKAN (security)
    // pastikan produk milik penjual yang login
    // if ($produk->id_penjual != auth()->id()) {
    //     abort(403);
    // }

    // ✅ update
    $produk->update([
        'harga' => $request->harga,
        'stok'  => $request->stok,
    ]);

    // ✅ response
    return redirect()
        ->back()
        ->with('success', 'Menu berhasil diperbarui');
}

    // 🔎 SEARCH PRODUK
public function searchProduk(Request $request)
{
    $keyword = $request->keyword;

    $produk = produk::with(['kategori','penjual'])
        ->whereHas('kategori', function ($query) use ($keyword) {
            $query->where('nama_produk', 'like', '%' . $keyword . '%');
        })
        ->get();

    return response()->json($produk);
}


public function indexSearch()
{
    $siswa = siswa::find(session('siswa_id'));

    $produk = produk::with(['kategori','penjual'])
        ->limit(5)
        ->get();

    return view('Search.index', compact('siswa','produk'));
}

// Daftar menu kantin
public function daftarMenuKantin()
{
    $kantinId = session('kantin_id');

    $kantin = Penjual::find($kantinId);

    $produk = Produk::with('kategori')
        ->where('id_penjual', $kantinId)
        ->get();

    return view('kantin.daftar_menu', compact('produk','kantin'));
}

public function destroyProduk($id)
{
    Produk::findOrFail($id)->delete();
    return redirect()->back()->with('success','Menu berhasil dihapus');
}

public function tambahkeranjan(Request $request)
{
    $siswa_id = session('siswa_id');
    $produk = Produk::find($request->produk_id);

    if (!$produk) return back();

    $cek = keranjang::where('siswa_id', $siswa_id)
        ->where('produk_id', $produk->id)
        ->first();

    if ($request->qty == 0) {
        if ($cek) {
            $cek->delete();
        }
        return back();
    }

    if ($cek) {
        $cek->update([
            'qty' => $request->qty
        ]);
    } else {
        Keranjang::create([
            'siswa_id' => $siswa_id,
            'produk_id' => $produk->id,
            'qty' => $request->qty,
            'harga' => $produk->harga
        ]);
    }

    return back();
}

public function updatekeranjang(Request $request)
    {
        $item = Keranjang::where('id', $request->produk_id)->first();

        if (!$item) {
            return response()->json(['error' => 'Item tidak ditemukan'], 404);
        }

        if ($request->qty > 0) {
            $item->qty = $request->qty;
            $item->save();
        } else {
            $item->delete();
        }

        return response()->json(['success' => true]);
}

    public function checkout()
    {
        $keranjang = Keranjang::with('produk')->where('siswa_id', session('siswa_id'))->get();

        if($keranjang->isEmpty()){
            return back()->with('error','Keranjang kosong');
        }

        // Group by kantin / penjual
        $keranjangGroup = $keranjang->groupBy('produk.id_penjual');

        DB::beginTransaction();
        try {
            foreach($keranjangGroup as $id_penjual => $items){
                $total = $items->sum(function($item){ return $item->harga * $item->qty; });

                $transaksi = Transaksi::create([
                    'id_siswa' => session('siswa_id'),
                    'id_penjual' => $id_penjual,
                    'total_harga' => $total,
                    'total' => $total,
                    'status' => 'pending',
                    'metode_pembayaran' => 'cash',
                ]);

                foreach($items as $item){

                // 🔴 ambil produk
                $produk = Produk::findOrFail($item->produk_id);

                // 🛑 VALIDASI stok cukup
                if ($produk->stok < $item->qty) {
                    throw new \Exception("Stok {$produk->nama} tidak cukup");
                }

                // ✅ kurangi stok
                $produk->stok -= $item->qty;
                $produk->save();

                // ✅ simpan detail transaksi
                detail::create([
                    'id_transaksi' => $transaksi->id,
                    'id_produk' => $item->produk_id,
                    'jumlah' => $item->qty,
                    'harga' => $item->harga,
                ]);
            }
    }

            // Hapus keranjang setelah semua transaksi berhasil
            Keranjang::where('siswa_id', session('siswa_id'))->delete();

            DB::commit();
            return back()->with('success','Checkout berhasil di semua kantin!');

        } catch(\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

    }

  public function prosesTransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Pastikan cuma pending yang bisa diproses
        if ($transaksi->status !== 'pending') {
            return back()->with('error', 'Status tidak bisa diproses.');
        }

        $transaksi->update([
            'status' => 'selesai'
        ]);

        return redirect()->route('dashboard.kantin')
            ->with('success', 'Pesanan berhasil diproses.');
    }




}
