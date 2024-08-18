<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index (Request $request){
        $data = Item::all();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">1</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('item.index', compact('data'));
    }
    public function create(Request $request){
        $data= new ProductModel;
        $data->product_code=$request->product_code;
        $data->product_description=$request->product_description;
        $data->serial_number=$request->serial_number;
        $data->sid=$request->sid;
        $data->status=$request->status;
        $data->save();
    }
}
