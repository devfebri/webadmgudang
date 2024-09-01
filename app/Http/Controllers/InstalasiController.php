<?php

namespace App\Http\Controllers;

use App\Models\Consumen;
use App\Models\Instalasi;
use App\Models\Paket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    public function index(Request $request)
    {
        $paket=Paket::all();
        $data = Instalasi::orderBy('id', 'desc')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    // $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                    if($f->status=='Waiting'){
                        $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    }else{
                        $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" disabled data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        // $instalasi = Instalasi::all();
        $consumen=Consumen::all();
        return view('instalasi.index', compact('data','paket','consumen'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $kodeBarang = Instalasi::orderBy('id','desc')->first()->kode_instalasi;
        $id = substr($kodeBarang, 0, 4);
        $newID = $id + 1;
        $newID = str_pad($newID,
            4,
            '0',
            STR_PAD_LEFT
        );
        $tahun=Carbon::now()->format('Y');

        $layanan=$request->layanan;
        if($layanan== 'Gangguan'){
            $newKodeInstalasi = $newID . '/GN/TLKM/' . $tahun;
            $data                    = new Instalasi();
            $data->kode_instalasi=$newKodeInstalasi;
            $data->layanan      =$layanan;
            $data->nomor_internet  =$request->no_internet;
            $data->deskripsi    =$request->deskripsi;
            $data->consumen_id  = $request->consumen_id;
            $data->status       = 'Waiting';
            $data->save();
        }else if($layanan=='Pasang Baru'){
            $newKodeInstalasi = $newID . '/PSB/TLKM/' . $tahun;
            $data               = new Instalasi();
            $data->kode_instalasi = $newKodeInstalasi;
            $data->layanan      = $layanan;
            $dpaket             =Paket::find($request->paket);
            $data->nama_paket   =$dpaket->nama_paket;
            $data->harga_paket  =$dpaket->harga;
            $data->consumen_id  = $request->consumen_id;
            $data->status       ='Waiting';
            $data->save();
        }else if($layanan=='Up Layanan'){
            $newKodeInstalasi = $newID . '/UP/TLKM/' . $tahun;
            $data               = new Instalasi();
            $data->kode_instalasi = $newKodeInstalasi;
            $data->layanan      = $layanan;
            $dpaket             = Paket::find($request->paket);
            $data->nama_paket   = $dpaket->nama_paket;
            $data->harga_paket  = $dpaket->harga;
            $data->nomor_internet  = $request->no_internet;
            $data->deskripsi    = $request->deskripsi;
            $data->consumen_id  = $request->consumen_id;
            $data->status       = 'Waiting';
            $data->save();
        }


        return response()->json($data);
    }
    public function delete($id)
    {
        $item = Item::find($id);
        $item->delete();
        return response()->json($item);
    }
}
