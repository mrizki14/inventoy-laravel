<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Category;
use App\Models\Codes;
use Illuminate\Http\Request;

class CodesController extends Controller
{
    public function kode(Request $request)
    {

        $kategori = Category::query()->select('id', 'nama_kategori')->get();
        $data = Codes::all();



        $kategori->when($request->nama_kategori, function ($query) use ($request){
            return $query->whereCategory($request->nama_kategori);
        });

        return view('/codes', compact('data'),
        [
            "title" => "Kode Barang",
            "kategori" => $kategori

        ]);
    }

    // Function Tambah
    public function tambah()
    {
        $kategori = Category::select('id', 'nama_kategori')->get();
        return view('data/kode_barang/add_codes',
        [
            "title" => "Tambah Kode Barang",
            "kategori" => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:codes|min:5',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'id_categories' => 'required'
        ],[
            'kode_barang.required' => 'Kode barang tidak boleh kosong',
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'jumlah_barang.required' => 'Jumlah barang tidak boleh kosong',
            'id_categories.required' => 'Kategories tidak boleh kosong',
        ]);

        $kode=Codes::create($request->all());
            return redirect('kode_barang')->with('success', 'Data berhasil di tambahkan');
    }

    public function edit($id) {
        $codes = Codes::findOrFail($id);
        $kategori = Category::get();
        return view ('/data/kode_barang/edit_codes', compact('codes'),[
            'title' => 'Edit Kode Barang',
            'kategori' => $kategori
        ]);

    }

    public function update(Request $request, $id) {
        $request->validate([
            'kode_barang' => 'required|unique:codes|min:5',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'id_categories' => 'required'
        ],[
            'kode_barang.required' => 'Kode barang tidak boleh kosong',
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'jumlah_barang.required' => 'Jumlah barang tidak boleh kosong',
            'id_categories.required' => 'Kategories tidak boleh kosong',
        ]);

        $update_codes = Codes::where('id', $id)->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'id_categories' => $request->id_categories,
          
        ]);

        return redirect()->route('code')->with('success', 'Kode Barang berhasil di update');

    }

    // Function Hapus
    public function hapus($id)
    {
        $code = Codes::find($id);
        $code->delete();
        return redirect('kode_barang')->with('success', 'Data berhasil di hapus');

    }
    
    public function logBarang (Request $request) {

        $barang = Codes::with(['barangMasuk', 'barangKeluar'])->get();   
        $row = BarangMasuk::all();
        // if(BarangMasuk::find('id') === true)  {
        // return new ($barang);
        // }    
        // $stockMasuk = BarangMasuk::all();
        // $stockMasuk->when($request->qty, function ($query) use ($request){
        //     return $query->whereCategory($request->qty);
        // });
        
        return view('log_barang',compact('barang'),[
            "title" => "Data Barang",
            'rows' => $row
            // 'stockMasuk' => $stockMasuk

        ]);
        
    }

    
}
