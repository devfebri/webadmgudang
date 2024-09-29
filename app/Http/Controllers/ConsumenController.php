<?php

namespace App\Http\Controllers;

use App\Models\Consumen;
use App\Models\Instalasi;
use App\Models\User;
use Illuminate\Http\Request;

class ConsumenController extends Controller
{
    public function index(Request $request)
    {
        $data = Consumen::orderBy('id', 'desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    // $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                    $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    $button .= '</div>';
                    return $button;
                })->addColumn('ttl', function ($f) {
                    $button = $f->tmpt_lahir . ', ' . $f->tgl_lahir->format('d/m/Y');
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('consumen.index', compact('data'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'no_hp' => 'unique:consumen',
        ]);
        // dd($request->all());
        $data                       = new Consumen;
        $data->nama                 = $request->nama;
        $data->nik                  = $request->nik;
        $data->no_hp                = $request->no_hp;
        $data->jk                   = $request->jk;
        $data->tgl_lahir            = $request->tgl_lahir;
        $data->tmpt_lahir           = $request->tmpt_lahir;
        $data->alamat               = $request->alamat;

        $user = new User;
        $user->username = $request->no_hp;
        $user->password = bcrypt($request->no_hp);
        $user->name = $request->nama;
        $user->role = 'consumen';
        $user->save();

        $data->user_id = $user->id;
        $data->save();

        return response()->json($data);
    }

    public function delete($id)
    {
        $consumen = Consumen::find($id);
        $user = User::find($consumen->user_id)->delete();
        $instalasi=Instalasi::where('consumen_id',$id)->delete();
        $consumen->delete();
        return response()->json($consumen);
    }
}
