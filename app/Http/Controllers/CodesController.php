<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Codes;
use App\Models\Category;
use App\Models\BarangMasuk;
use App\Models\LogBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class CodesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:barang-list|barang-create|barang-edit|barang-delete', ['only' => ['kode']]);
         $this->middleware('permission:barang-create', ['only' => ['tambah','store']]);
         $this->middleware('permission:barang-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:barang-delete', ['only' => ['hapus']]);
    }
    public function kode(Request $request)
    {

       $barangs = Codes::all();

        return view('/codes', compact('barangs'),
        [
            "title" => "Kode Barang",

        ]);
    }

    public function search(Request $request) {
        $search = $request->search;
        $barangs = Codes::where(function($query) use ($search){
            $query->where('kode_barang','like',"%$search%")
            ->orWhere('nama_barang','like',"%$search%")
            ->orWhere('jumlah_barang','like',"%$search%");
        })
        ->orWhereHas('categories', function($query) use ($search) {
            $query->where('nama_kategori','like',"%$search%");
        })
        ->get();

        return view ('codes', compact('barangs','search'),[
            "title" => "Kode Barang",
            
        ]
        );
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
    
    

    
}
