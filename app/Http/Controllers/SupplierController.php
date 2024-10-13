<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSupplier;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $data = Supplier::orderBy('id', 'desc')->get();
        $item=Item::all();

        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    $button .= '<a href="' . asset('storage/surat_masuk/' . auth()->user()->username . '/' . $f->file_surat) . '" target="_blank" style="margin: 5px;" class="tabledit-edit-button btn btn-sm btn-info"><span class="ti-import"></span></a>';
                    // $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('supplier', function ($f) {
                    $is =DB::table('item_supplier')
                        ->select('item.id', 'item.nama', 'item.type')
                        ->join('item','item.id','=','item_supplier.item_id')
                        ->where('item_supplier.supplier_id',$f->id)
                        ->get();
                    $button='';
                    foreach($is as $row){

                        $button.= '<span class="badge badge-pill badge-primary">'.$row->nama.' - '.$row->type.'</span>';
                    }
                    return $button;
                })
                ->rawColumns(['action','supplier'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('supplier.index', compact('data','item'));
    }
    public function create(Request $request)
    {

        $data                                   = new Supplier();
        $data->no_surat                         = $request->no_surat;
        $data->nama_supplier                    = $request->nama_supplier;
        $data->nama_penerima                    = $request->nama_penerima;
        $data->nama_pengirim                    = $request->nama_pengirim;
        $data->jml_barang                       = $request->jml_barang;

        if ($request->has('file_surat')) {
            $file = $request->file('file_surat');
            $filename = $file->getClientOriginalName() . '-' . time() . '.' . $file->extension();
            $file->move(public_path() . '/storage/surat_masuk/' . auth()->user()->username, $filename);
            // dd('melahirkani');
        }
        $data->file_surat                       = $filename;
        $data->save();
        foreach ($request->item_id as $row) {
            $is = new ItemSupplier;
            $is->item_id = $row;
            $is->supplier_id = $data->id;
            $is->save();

            $item=Item::find($row);
            $stokbaru=$item->stok+$request->jml_barang;
            // dd($stokbaru);
            $item->update(['stok'=>$stokbaru]);
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        // $image = public_path() . '/storage/surat_masuk/' . auth()->user()->username . '/' . $supplier->file_surat;
        $image ='/public/surat_masuk/' . auth()->user()->username . '/' . $supplier->file_surat;
        // dd(Storage::exists('/public/surat_masuk/' . auth()->user()->username . '/' . $supplier->file_surat));
        if (Storage::exists($image)) {
            Storage::delete($image);
            // $item=Item::where('supplier_id',$id)->delete();
        }
        ItemSupplier::where('supplier_id',$id)->delete();
        $supplier->delete();
        return response()->json($supplier);
    }
}
