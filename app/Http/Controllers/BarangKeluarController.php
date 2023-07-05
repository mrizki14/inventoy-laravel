<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index () {
        $barang = BarangKeluar::all();
        $data = Codes::select('kode_barang','nama_barang','id_categories')->get();
        return view('barang_keluar',compact('barang'), [
            "title" => "Barang Keluar",
            "data" => $data
        ]);
    }

    public function tambah () {
        $codes = Codes::all();
        return view('/data/barang_keluar/add_barang_keluar',
        [   
            "title" => "Tambah Barang Keluar",
            "codes" => $codes
        ]);
        
    }

    public function store (Request $request) {
        $request->validate([
            'codes_id' => 'required',
            'qty' => 'required',
            'tgl_keluar' => 'required',
            'barang_id' => 'nullable',
        ], [
            'codes_id.required' => 'kode barang tidak boleh kosong',
            'qty.required' => 'jumlah barang tidak boleh kosong',
            'tgl_keluar.required' => 'tgl barang tidak boleh kosong',
        ]);

        // $brg = Codes::findOrFail($request->codes_id);
        // $brg->jumlah_barang -= $request->qty;
        // $brg->save();

        $input_barang = BarangKeluar::create($request->all());

        return redirect()->route('barang.keluar')->with('success', 'Barang berhasil di keluarkan');

    }

    public function edit($id) {
        $barang = BarangKeluar::findOrFail($id);
        $codes = Codes::get();
        return view('data/barang_keluar/edit_barang_keluar', compact('barang'),[
            'title' => 'Edit Barang Keluar',
            'codes' => $codes
        ]);
    }

    public function update (Request $request, $id) {
        $request->validate([
            'codes_id' => 'required',
            'qty' => 'required',
            'tgl_keluar' => 'required',
            'barang_id' => 'nullable',
        ],[
            'codes_id.required' => 'kode barang tidak boleh kosong',
            'qty.required' => 'jumlah tidak boleh kosong',
            'tgl_keluar.required' => 'tgl barang tidak boleh kosong',
        ]);

        
        $update_barang = BarangKeluar::where('id', $id)->update([
            'codes_id' => $request->codes_id,
            'qty' => $request->qty,
            'tgl_keluar' => $request->tgl_keluar,
            
        ]);

        $brg = Codes::findOrFail($request->codes_id);
        $brg->jumlah_barang -= $request->qty;
        $brg->save();

        return redirect()->route('barang.keluar')->with('success', 'barang berhasil di update');

    }

    public function hapus($id)
    {
        $barang = BarangKeluar::find($id);
        $barang->delete();
        return redirect()->route('barang.keluar')->with('success', 'Barang berhasil di hapus');

    }
}
