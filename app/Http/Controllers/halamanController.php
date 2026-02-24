<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\admin;
use App\Models\penjual;
use App\Models\produk;
use App\Models\Kategori;
use App\Models\transaksi;
use App\Models\Keranjang;
use App\Models\nis;

class halamanController extends Controller
{
    public function index1()
    {
        $produk = produk::with('kategori', 'penjual')->get();
        $kantin = penjual::orderBy('no_kantin', 'asc')->get();
        $siswa = siswa::find(session('siswa_id'));
        return view('index.index', compact('siswa', 'kantin', 'produk'));
    }

    public function index5()
    {
        $produk = Produk::with('kategori', 'penjual')
        ->whereHas('kategori', function ($query) {
            $query->where('jenis', 'Makanan');
        })
        ->get();

        $kantin = penjual::orderBy('no_kantin', 'asc')->get();
        $siswa = siswa::find(session('siswa_id'));
        return view('index.makanan', compact('siswa', 'kantin', 'produk'));
    }

    public function index7()
    {
        $produk = Produk::with('kategori', 'penjual')
        ->whereHas('kategori', function ($query) {
            $query->where('jenis', 'minuman');
        })
        ->get();

        $kantin = penjual::orderBy('no_kantin', 'asc')->get();
        $siswa = siswa::find(session('siswa_id'));
        return view('index.minuman', compact('siswa', 'kantin', 'produk'));
    }

    public function index4($id)
    {
        // Ambil data kantin
        $kantin = Penjual::findOrFail($id);

        // Ambil produk kantin itu saja
        $produk = Produk::with('kategori', 'penjual')
            ->where('id_penjual', $id)
            ->get();
        $siswa = siswa::find(session('siswa_id'));
        return view('pilih_kantin.index', compact('siswa', 'kantin', 'produk'));
    }

    public function index12($id)
    {
        // Ambil data kantin
        $kantin = Penjual::findOrFail($id);

        $produk = Produk::with('kategori', 'penjual')
        ->where('id_penjual', $id)
        ->whereHas('kategori', function ($query) {
            $query->where('jenis', 'makanan');
        })
        ->get();
        $siswa = siswa::find(session('siswa_id'));
        return view('pilih_kantin.makanan', compact('siswa', 'kantin', 'produk'));
    }

    public function index13($id)
    {
        // Ambil data kantin
        $kantin = Penjual::findOrFail($id);

        $produk = Produk::with('kategori', 'penjual')
        ->where('id_penjual', $id)
        ->whereHas('kategori', function ($query) {
            $query->where('jenis', 'minuman');
        })
        ->get();
        $siswa = siswa::find(session('siswa_id'));
        return view('pilih_kantin.minuman', compact('siswa', 'kantin', 'produk'));
    }

    public function index6()
    {
        $siswa_id = session('siswa_id'); // <-- TAMBAHKAN INI

        $keranjang = Keranjang::with('produk.kategori', 'produk.penjual')
        ->where('siswa_id', session('siswa_id'))
        ->get();

        // Hitung total
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item->harga * $item->qty;
        }

        $siswa = Siswa::find($siswa_id);

        $transaksi = Transaksi::with(['siswa','detail.produk'])
            ->where('id_siswa', $siswa_id)
            ->whereIn('status', ['pending','diproses'])
            ->orderBy('created_at','desc')
            ->get();

        return view('keranjang.index', compact('keranjang', 'siswa', 'total', 'transaksi'));
    }

    
    public function index8()
    {
        $siswa = siswa::find(session('siswa_id'));
        return view('Search.index', compact('siswa'));
    }

    public function index14()
    {
        $siswaId = session('siswa_id');
        $siswa = Siswa::findOrFail($siswaId);

        // Ambil semua transaksi siswa dengan detail produk
        $transaksi = Transaksi::with(['siswa', 'detail.produk.kategori', 'detail.produk.penjual'])
            ->where('id_siswa', $siswaId)
            ->latest()
            ->get();

        return view('riwayat.siswa', compact('siswa', 'transaksi'));

    }

    public function index9()
    {
        $siswa = siswa::find(session('siswa_id'));
        return view('profile_page.index', compact('siswa'));
    }

    public function index2()
    {
        return view('akun_siswa.daftar');
    }
    
    public function index3()
    {
        return view('akun_siswa.login');
    }

    public function index10()
    {
        return view('admin_bule.daftar');
    }

    public function index11()
    {
        return view('admin_bule.login');
    }


public function index15()
{
    $kantinId = session('kantin_id');

    if (!$kantinId) {
        dd('Session kantin kosong bro');
    }

    $kantin = Penjual::findOrFail($kantinId);

    $transaksi = Transaksi::with(['siswa','detail.produk'])
        ->where('id_penjual', $kantinId)
        ->whereIn('status', ['pending','diproses'])
        ->orderBy('created_at','desc')
        ->get();

    return view('admin_bule.index', compact('kantin','transaksi'));
}

public function orderTerbaru()
{
    $kantinId = session('kantin_id');

    $transaksi = Transaksi::with(['siswa','detail.produk.kategori'])
        ->where('id_penjual', $kantinId)
        ->whereIn('status', ['pending','diproses']) 
        ->orderBy('created_at','desc')
        ->get();

    return response()->json($transaksi);
}


   public function index16()
{
    $kantinId = session('kantin_id');
    $kantin = Penjual::findOrFail($kantinId);

    $transaksi = Transaksi::with(['siswa','detail.produk.kategori'])
        ->where('id_penjual', $kantinId)
        ->latest()
        ->get();

    return view('riwayat.kantin', compact('transaksi','kantin'));
}


    public function index17()
    {
        $makanan = Kategori::where('jenis', 'Makanan')->get();
        $minuman = Kategori::where('jenis', 'Minuman')->get();
        $kantin = penjual::find(session('kantin_id'));
        return view('admin_bule.tambah_menu', compact('makanan', 'minuman', 'kantin'));
    }

    public function index18()
    {
        $kantin = penjual::withSum(['transaksi as total_hari_ini' => function ($q) {
            $q->whereDate('created_at', today());
        }], 'total_harga')->get();
        $totalSiswa = siswa::count();
        $totaltransaksi = transaksi::count();
        $jumlahOnline = penjual::where('last_seen', '>=', now()->subMinutes(1))->count();
        $totalKantin = penjual::count();
        return view('super_user.index', compact('totalSiswa', 'totaltransaksi', 'jumlahOnline', 'kantin', 'totalKantin'));
    }

    public function index19()
    {
        return view('super_user.laporan');
    }

    public function index20()
    {
        $kantin = penjual::all();
        return view('super_user.manajemen_kantin', compact('kantin'));
    }

    public function index21()
    {
        $kantin = penjual::find(session('kantin_id'));
        return view('profile_page.kantin', compact('kantin'));
    }
    
    public function index22()
    {
        $siswa = siswa::all();
        return view('super_user.siswa', compact('siswa'));
    }

    public function index23()
    {
        $transaksi = Transaksi::with([
            'siswa',
            'detail.produk.kategori',
            'detail.produk.penjual'
        ])->get(); // ← WAJIB

        return view('super_user.riwayat_transaksi', compact('transaksi'));
    }

    public function index24()
    {
        return view('super_user.login');
    }

    public function index25()
    {
        $admin = admin::all();
        return view('super_user.data_admin', compact('admin'));
    }

    public function index26()
    {
        $kategori = kategori::all();
        $penjual = penjual::all();
        $produk = produk::all();
        return view('super_user.produk', compact('kategori', 'penjual',  'produk'));
    }

    public function index27()
    {
        $nis = nis::all();
        return view('super_user.nis', compact('nis') );
    }

    public function index28()
    {
        $produk = Produk::with('kategori', 'penjual')
        ->where('id_penjual', session('kantin_id'))
        ->get();
        return view('admin_bule.daftar_menu', compact('produk') );
    }
}
