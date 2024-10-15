<?php

namespace App\Http\Controllers;

use App\Models\Consumen;
use App\Models\Instalasi;
use App\Models\Paket;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;
use PDF;
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
                    // dd($f->status);
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';


                    if($f->status=='Waiting'){
                        $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                        $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    }else{
                        $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" disabled data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                        $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" disabled data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('nama_consumen',function($f){
                    $buttons=Consumen::find($f->consumen_id)->nama;
                    return $buttons;
                })
                ->rawColumns(['action','nama_consumen'])
                ->addIndexColumn()
                ->make(true);
        }
        // $instalasi = Instalasi::all();
        $consumen=Consumen::all();
        return view('instalasi.index', compact('data','paket','consumen'));
    }

    public function delete($id)
    {
        $item = Instalasi::find($id);
        $item->delete();
        return response()->json($item);
    }

    public function create(Request $request)
    {
        if($request->id){
            // dd($request->all());
            $layanan = $request->layanan;
            if ($layanan == 'Gangguan') {
                $instalasi = Instalasi::find($request->id);
                $instalasi->update([
                    'layanan'           => $layanan,
                    'nomor_internet'    => $request->no_internet,
                    'deskripsi'         => $request->deskripsi,
                    'consumen_id'       => $request->consumen_id
                ]);
            } else if ($layanan == 'Pasang Baru') {
                $instalasi              = Instalasi::find($request->id);
                $dpaket                 = Paket::find($request->paket);
                $instalasi->update([
                    'layanan'           => $layanan,
                    'nomor_internet'    => $request->no_internet,
                    'deskripsi'         => $request->deskripsi,
                    'consumen_id'       => $request->consumen_id,
                    'nama_paket'        => $dpaket->nama_paket,
                    'harga_paket'       => $dpaket->harga,
                ]);
            } else if ($layanan == 'Up Layanan') {
                $instalasi              = Instalasi::find($request->id);
                $dpaket                 = Paket::find($request->paket);
                $instalasi->update([
                    'layanan'           => $layanan,
                    'nomor_internet'    => $request->no_internet,
                    'deskripsi'         => $request->deskripsi,
                    'consumen_id'       => $request->consumen_id,
                    'nama_paket'        => $dpaket->nama_paket,
                    'harga_paket'       => $dpaket->harga,
                ]);
            }
            return response()->json($instalasi);
        }else{
            $jmlBarang = Instalasi::all()->count();
            // dd($kodeBarang);
            if ($jmlBarang == 0) {
                $kodeBarang = 0;
            } else {
                $kodeBarang = Instalasi::orderBy('id', 'desc')->first()->kode_instalasi;
            }
            $id = substr($kodeBarang, 0, 4);
            $newID = $id + 1;
            $newID = str_pad(
                $newID,
                4,
                '0',
                STR_PAD_LEFT
            );
            $tahun = Carbon::now()->format('Y');

            $layanan = $request->layanan;
            if ($layanan == 'Gangguan') {
                $newKodeInstalasi = $newID . '/GN/TLKM/' . $tahun;
                $data                    = new Instalasi();
                $data->kode_instalasi = $newKodeInstalasi;
                $data->layanan      = $layanan;
                $data->nomor_internet  = $request->no_internet;
                $data->deskripsi    = $request->deskripsi;
                $data->consumen_id  = $request->consumen_id;
                $data->status       = 'Waiting';
                $data->save();
            } else if ($layanan == 'Pasang Baru') {
                $newKodeInstalasi = $newID . '/PSB/TLKM/' . $tahun;
                $data               = new Instalasi();
                $data->kode_instalasi = $newKodeInstalasi;
                $data->layanan      = $layanan;
                $dpaket             = Paket::find($request->paket);
                $data->nama_paket   = $dpaket->nama_paket;
                $data->harga_paket  = $dpaket->harga;
                $data->consumen_id  = $request->consumen_id;
                $data->status       = 'Waiting';
                $data->save();
            } else if ($layanan == 'Up Layanan') {
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




    }

    public function laporan()
    {
        return view('instalasi.laporan');
    }

    public function download(Request $request)
    {
        // $data = Instalasi::all();
        $data = [
            'instalasi' => Instalasi::whereBetween('created_at', [$request->start_date, $request->end_date])->get(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];
        // dd($data['instalasi']->get());
        $pdf = PDF::loadView('instalasi.pdf', $data);


        return $pdf->stream('document.pdf');
    }

    public function edit($id)
    {
        // dd($id);
        $data = instalasi::find($id);
        // dd($data['tgl_lahir']);
        // $data=User::find($consumen->user_id);
        return response()->json($data);
    }


}
