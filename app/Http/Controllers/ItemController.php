<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
                    $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('item.index', compact('data'));
    }
    public function create(Request $request){
        $data                    = new Item;
        $data->serial_number    = $request->serial_number;
        $data->nama             = $request->nama;
        $data->type             = $request->type;
        $data->jenis            = $request->jenis;
        $data->owner            = $request->owner;
        $data->supplier         = $request->supplier;
        $data->status           = $request->status;
        $data->save();


        return response()->json($data);
    }
}
