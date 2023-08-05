<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Category;
use App\Models\Codes;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index () {
        $barang = BarangMasuk::paginate(10)->fragment('brg');
        return view('barang_masuk',compact('barang'), [
            "title" => "Barang Masuk",
        ]);
    }

    public function search(Request $request) {
        $search = $request->search;
        $barang = BarangMasuk::where(function($query) use ($search){
            $query->where('qty','like',"%$search%");
        })
        ->orWhereHas('codes', function($query) use ($search) {
            $query->where('kode_barang','like',"%$search%")
            ->orWhere('nama_barang','like',"%$search%")
            ->orWhere('jumlah_barang','like',"%$search%")
            ->orWhere('tgl_masuk','like',"%$search%");
        })
        ->orWhereHas('codes.categories', function($query) use ($search) {
            $query->where('nama_kategori','like',"%$search%");
        })
        ->get();
        return view ('barang_masuk', compact(['barang','search']),[
            "title" => "Barang Masuk",
            
        ]
        );
        }

    public function tambah () {
        $codes = Codes::all();
        return view('/data/barang_masuk/add_barang',
        [   
            "title" => "Tambah Barang Masuk",
            "codes" => $codes
        ]);
        
    }

    public function store (Request $request) {
        $request->validate([
            'codes_id' => 'required',
            'qty' => 'required',
            'tgl_masuk' => 'required',
        ], [
            'codes_id.required' => 'kode barang tidak boleh kosong',
            'qty.required' => 'jumlah barang tidak boleh kosong',
            'tgl_masuk.required' => 'tgl barang tidak boleh kosong',
        ]);

        // $brg = Codes::findOrFail($request->codes_id);
        // $brg->jumlah_barang += $request->qty;
        // $brg->save();

        $input_barang = BarangMasuk::create($request->all());

        return redirect('barang_masuk')->with('success', 'Barang berhasil di tambahkan');


    }

    public function edit($id) {
        $barang = BarangMasuk::findOrFail($id);
        $codes = Codes::get();
        return view('data/barang_masuk/edit_barang', compact('barang'),[
            'title' => 'Edit Barang Masuk',
            'codes' => $codes
        ]);
    }

    public function update (Request $request, $id) {
        $request->validate([
            'codes_id' => 'required',
            'qty' => 'required',
            'tgl_masuk' => 'required',
        ],[
            'codes_id.required' => 'kode barang tidak boleh kosong',
            'qty.required' => 'jumlah tidak boleh kosong',
            'tgl_masuk.required' => 'tgl barang tidak boleh kosong',
        ]);

        
        $update_barang = BarangMasuk::where('id', $id)->update([
            'codes_id' => $request->codes_id,
            'qty' => $request->qty,
            'tgl_masuk' => $request->tgl_masuk,
            
        ]);

        // $brg = Codes::findOrFail($request->codes_id);
        // $brg->jumlah_barang += $request->qty;
        // $brg->save();

        return redirect()->route('barang.masuk')->with('success', 'barang berhasil di update');

    }

    public function hapus($id)
    {
        $barang = BarangMasuk::find($id);
        $barang->delete();
        return redirect()->route('barang.masuk')->with('success', 'Barang berhasil di hapus');

    }

    
}
