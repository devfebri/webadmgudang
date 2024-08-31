<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index(Request $request)
    {
        $data = Teknisi::orderBy('id', 'desc')->get();
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
                    $button = $f->tmpt_lahir.', '.$f->tgl_lahir->format('d/m/Y');
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('teknisi.index', compact('data'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $data                       = new Teknisi;
        $data->nama                 = $request->nama;
        $data->nik                  = $request->nik;
        $data->no_hp                = $request->no_hp;
        $data->jk                   = $request->jk;
        $data->tgl_lahir            = $request->tgl_lahir;
        $data->tmpt_lahir           = $request->tmpt_lahir;
        $data->alamat               =  $request->alamat;



        $user = new User;
        $user->username=$request->nik;
        $user->password=bcrypt($request->nik);
        $user->name=$request->nama;
        $user->role='teknisi';
        $user->save();

        $data->user_id=$user->id;
        $data->save();
        // $data=Teknisi::create($request->all());

        return response()->json($data);
    }

    public function delete($id)
    {
        $teknisi = Teknisi::find($id);
        $user = User::find($teknisi->user_id)->delete();
        $teknisi->delete();
        return response()->json($teknisi);
    }
}
