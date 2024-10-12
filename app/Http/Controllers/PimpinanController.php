<?php

namespace App\Http\Controllers;

use App\Models\Pimpinan;
use App\Models\User;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index(Request $request)
    {
        $data = Pimpinan::orderBy('id', 'desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
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
        return view('pimpinan.index', compact('data'));
    }
    public function create(Request $request)
    {
        if ($request->id) {
            $data = Pimpinan::find($request->id);
            $user = User::find($data->user_id);
            $data->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                // 'no_hp'=>$request->no_hp,
                'jk' => $request->jk,
                'tgl_lahir' => $request->tgl_lahir,
                'tmpt_lahir' => $request->tmpt_lahir,
                'alamat' => $request->alamat
            ]);
            $user->update(['name' => $request->nama]);
        } else {
            $request->validate([
                'no_hp' => 'unique:pimpinan',
            ]);
            $data                       = new Pimpinan();
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
            $user->role = 'pimpinan';
            $user->save();

            $data->user_id = $user->id;
            $data->save();
        }
        return response()->json($data);
    }

    public function delete($id)
    {
        $consumen = Pimpinan::find($id);
        $user = User::find($consumen->user_id)->delete();
        $consumen->delete();
        return response()->json($consumen);
    }

    public function edit($id)
    {
        // dd($id);
        $data['pimpinan'] = Pimpinan::find($id);
        $data['tgl_lahir'] = $data['pimpinan']->tgl_lahir->format('Y-m-d');
        // dd($data['tgl_lahir']);
        // $data=User::find($consumen->user_id);
        return response()->json($data);
    }
}
