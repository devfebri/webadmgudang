<?php

namespace App\Http\Controllers;

use App\Models\Instalasi;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    public function index(Request $request)
    {
        $data = Instalasi::orderBy('id', 'desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        $instalasi = Instalasi::all();
        return view('instalasi.index', compact('data', 'instalasi'));
    }
    public function create(Request $request)
    {
        $data                    = new Item;
        $data->consumen_id      = auth()->user()->id;
        $data->layanan           = $request->layanan;
        $data->deskripsi        = $request->deskripsi;
        $data->nama_paket       =$request->nama_paket;
        $data->harga            =   $request->harga;
        $data->save();


        return response()->json($data);
    }
    public function delete($id)
    {
        $item = Item::find($id);
        $item->delete();
        return response()->json($item);
    }
}
