<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index (Request $request){
        $data = Item::orderBy('id','desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                    // $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $supplier=Supplier::all();
        return view('item.index', compact('data','supplier'));
    }
    public function create(Request $request){
        // dd($request->all());
        if($request->id){
            $data=Item::find($request->id);
            $data->update([
                'nama'=>$request->nama,
                'type'=>$request->type,
                'jenis'=>$request->jenis,
                'stok'=>$request->stok,
                'owner'=>$request->owner,
                'status'=>$request->status
            ]);
        }else{
            $data                    = new Item;
            $data->nama             = $request->nama;
            $data->type             = $request->type;
            $data->jenis            = $request->jenis;
            $data->owner            = $request->owner;
            $data->status           = $request->status;
            $data->stok             = $request->stok;
            $data->save();
        }



        return response()->json($data);
    }
    public function delete($id)
    {
        $item = Item::find($id);
        $wo=WorkOrder::where('item_id',$id)->delete();

        $item->delete();
        return response()->json($item);
    }

    public function edit($id)
    {
        // dd($id);
        $data = Item::find($id);
        // dd($data['tgl_lahir']);
        // $data=User::find($consumen->user_id);
        return response()->json($data);
    }
}
