<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $data = BarangKeluar::orderBy('id', 'desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    $button .= '<a href="' . asset('storage/barang_keluar/' . auth()->user()->username . '/' . $f->file_surat) . '" target="_blank" style="margin: 5px;" class="tabledit-edit-button btn btn-sm btn-info"><span class="ti-import"></span></a>';
                    $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('supplier.barangkeluar', compact('data'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $data                                   = new BarangKeluar();
        $data->no_surat                         = $request->no_surat;
        $data->nama_supplier                    = $request->nama_supplier;
        $data->nama_penerima                    = $request->nama_penerima;
        $data->nama_pengirim                    = $request->nama_pengirim;
        $data->jml_barang                       = $request->jml_barang;
        if ($request->has('file_surat')) {
            $file = $request->file('file_surat');
            $filename = $file->getClientOriginalName() . '-' . time() . '.' . $file->extension();
            $file->move(public_path() . '/storage/barang_keluar/' . auth()->user()->username, $filename);
            // dd('melahirkani');
        }
        $data->file_surat                       = $filename;
        $data->save();

        return response()->json($data);
    }

    public function delete($id)
    {
        $supplier = BarangKeluar::find($id);
        // $image = public_path() . '/storage/surat_masuk/' . auth()->user()->username . '/' . $supplier->file_surat;
        $image = '/public/barang_keluar/' . auth()->user()->username . '/' . $supplier->file_surat;
        // dd(Storage::exists('/public/surat_masuk/' . auth()->user()->username . '/' . $supplier->file_surat));

        $supplier->delete();
        return response()->json($supplier);
    }
}
