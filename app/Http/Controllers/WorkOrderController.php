<?php

namespace App\Http\Controllers;

use App\Models\Consumen;
use App\Models\Instalasi;
use App\Models\Item;
use App\Models\Teknisi;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrderController extends Controller
{
    public function index(Request $request)
    {
        $data = WorkOrder::orderBy('id', 'desc')->get();
        $instalasi=DB::table('instalasi')
            ->join('consumen', 'consumen.id', '=', 'instalasi.consumen_id')
            ->select('instalasi.id','instalasi.kode_instalasi', 'consumen.nama')
            ->where('instalasi.status','Waiting')
            ->get();
            $teknisi=Teknisi::all();
            $item=Item::all();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($f) {
                    $button = '<div class="tabledit-toolbar btn-toolbar" style="text-align: center;">';
                    // $button .= '<button class="tabledit-edit-button btn btn-sm btn-warning edit-post" data-id=' . $f->id . ' id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>';
                    if ($f->status == 'Waiting') {
                        $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    } else {
                        $button .= '<button class="tabledit-delete-button btn btn-sm btn-danger delete" disabled data-id=' . $f->id . ' style="float: none; margin: 5px;"><span class="ti-trash"></span></button>';
                    }
                    $button .= '</div>';
                    return $button;
                })->addColumn('nama_teknisi', function ($f) {
                    $teknisi=Teknisi::find($f->teknisi_id)->nama;

                    return $teknisi;
                })->addColumn('nohp_teknisi', function ($f) {
                    $button = Teknisi::find($f->teknisi_id)->no_hp;

                    return $button;
                })->addColumn('nohp_consumen', function ($f) {
                    $id = Instalasi::find($f->instalasi_id)->consumen_id;
                    $consumen=Consumen::find($id)->no_hp;
                    // dd($teknisi);
                    return $consumen;
                })->addColumn('item', function ($f) {
                $item = Item::find($f->item_id)->nama;
                // dd($teknisi);
                return $item;
            })
                ->rawColumns(['action','nama_teknisi','nohp_teknisi','nohp_consumen','item'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('wo.index', compact('data','instalasi','teknisi','item'));
    }
    public function create(Request $request)
    {
        $layanan=Instalasi::find($request->instalasi_id)->layanan;
        $wo = WorkOrder::orderBy('id', 'desc');
        if($wo->count()!=0){
            $kodeBarang= $wo->first()->nomor_wo;
            $id = substr($kodeBarang, 0, 4);
            $newID = $id + 1;
            $newID = str_pad(
                $newID,
                4,
                '0',
                STR_PAD_LEFT
            );
            $tahun = Carbon::now()->format('Y');
            $newNomorWo = $newID . '/WO/TLKM/' . $tahun;
        }else{
            $tahun = Carbon::now()->format('Y');
            $newNomorWo = '0001/WO/TLKM/' . $tahun;
        }
        // dd($kodeBarang);

        $data                       = new WorkOrder();
        $data->pesan                 = $request->pesan;
        $data->instalasi_id                = $request->instalasi_id;
        $data->teknisi_id                = $request->teknisi_id;
        $data->nomor_wo                = $newNomorWo;
        $data->item_id                = $request->item_id;
        $data->jenis_wo                = $layanan;
        // Instalasi::find($request->instalasi_id)->update(['status'=>'Proses']);
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
