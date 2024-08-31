<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        $data = Paket::orderBy('id', 'desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    // $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                    $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('paket.index', compact('data'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $data                               = new Paket;
        $data->nama_paket                   = $request->nama_paket;
        $data->internet                     = $request->internet;
        $data->tv                           = $request->tv;
        $data->telpon                       = $request->telpon;

        $data->save();

        return response()->json($data);
    }

    public function delete($id)
    {
        $paket = Paket::find($id);
        $paket->delete();
        return response()->json($paket);
    }
}
