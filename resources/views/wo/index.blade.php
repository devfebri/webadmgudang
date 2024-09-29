@extends('layouts.master')
@section('css')

<link href="{{ asset('template/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />


@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    @if(auth()->user()->role=='admin')

                    <h4 class="page-title">Work Order <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button></h4>
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor WO</th>
                                    <th>Jenis WO</th>
                                    <th>Item</th>
                                    <th>Pesan</th>
                                    <th>Teknisi</th>
                                    <th>No Telpon Teknisi</th>
                                    <th>No Telpon Consumen</th>
                                    <th>Status</th>
                                    @if(auth()->user()->role=='teknisi')
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="tambah-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="form-tambah-edit" name="form-tambah-edit">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">

                            <div class="form-group">
                                <label>Instalasi</label>
                                <select class="form-control " name="instalasi_id" id="instalasi_id" required>
                                    <option value="">-pilih-</option>
                                    @foreach ($instalasi as $row)
                                    <option value="{{ $row->id }}">{{ $row->kode_instalasi }} - {{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                 <label>Item</label>
                                 <select class="form-control " name="item_id" id="item_id" required>
                                     <option value="">-pilih-</option>
                                     @foreach ($item as $row2)
                                     <option value="{{ $row2->id }}">{{ $row2->sarial_number }} - {{ $row2->nama }}</option>
                                     @endforeach
                                 </select>
                             </div>

                            <div class="form-group">
                                <label>Teknisi</label>
                                <select class="form-control " name="teknisi_id" id="teknisi_id" required>
                                    <option value="">-pilih-</option>
                                    @foreach ($teknisi as $row1)
                                    <option value="{{ $row1->id }}">{{ $row1->nama }} - {{ $row1->no_hp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pesan Untuk Teknisi</label>
                                <textarea name="pesan" id="pesan" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="tombol-simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('javascript')

<!-- Jquery-Ui -->
<script src="{{ asset('template/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('template/assets/plugins/moment/moment.js') }}"></script>
<script src='{{ asset('template/assets/plugins/fullcalendar/js/fullcalendar.min.js') }}'></script>
<script src='{{ asset('template/assets/plugins/select2/select2.min.js') }}'></script>
<script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".select2").select2({
            width: '100%'
        });
        var table = $('#data_table').DataTable({
            processing: true
            , serverSide: true
             ,scrollX: true

            , ajax: "{{ route(auth()->user()->role.'_workorder') }}"
            , columns: [{
                    data: null
                    , sortable: false
                    , render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                , }
                , {
                    data: 'nomor_wo'
                    , name: 'nomor_wo'
                }
                , {
                    data: 'jenis_wo'
                    , name: 'jenis_wo'
                }
                , {
                    data: 'item'
                    , name: 'item'
                }
                , {
                    data: 'pesan'
                    , name: 'pesan'
                }
                , {
                    data: 'nama_teknisi'
                    , name: 'nama_teknisi'
                }
                , {
                    data: 'nohp_teknisi'
                    , name: 'nohp_teknisi'
                }
                , {
                    data: 'nohp_consumen'
                    , name: 'nohp_consumen'
                },
                 {
                    data: 'status'
                    , name: 'status'
                },
                @if(auth()->user()->role=='teknisi')
                {
                    data: 'action'
                    , name: 'action'
                }
                @endif
            ]
        });
        @if(auth()->user()->role=='admin')
            $('#btntambah').on('click', function() {
                $('#tambah-edit-modal').modal('show');
                $('#modal-judul').html('Tambah Data');
            });
            if ($("#form-tambah-edit").length > 0) {
                $("#form-tambah-edit").validate({
                    submitHandler: function(form) {
                        var actionType = $('#tombol-simpan').val();
                        var simpan = $('#tombol-simpan').html('Sending..');
                        $.ajax({
                            data: $('#form-tambah-edit')
                                .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                            url: "{{ route(auth()->user()->role.'_workordercreate') }}", //url simpan data
                            type: "POST", //karena simpan kita pakai method POST
                            dataType: 'json'
                            , success: function(data) { //jika berhasil
                                $('#form-tambah-edit').trigger("reset"); //form
                                $('#tambah-edit-modal').modal('hide'); //modal hide
                                $('#tombol-simpan').html('Simpan'); //tombol simpan
                                var oTable = $('#data_table')
                                    .dataTable(); //inialisasi datatable
                                oTable.fnDraw(false);
                            }
                            , error: function(data) { //jika error tampilkan error pada console
                                $('#tombol-simpan').html('Simpan');
                            }
                        });
                    }
                });
            }
            $('body').on('click', '.delete', function(id) {
                var dataid = $(this).attr('data-id');
                var url = "{{ route(auth()->user()->role.'_workorderdelete', ':dataid') }}";
                urls = url.replace(':dataid', dataid);
                alertify.confirm('Seluruh data yang berkaitan di paket ini akan ikut terhapus, apa anda yakin ?', function() {
                    $.ajax({
                        url: urls, //eksekusi ajax ke url ini
                        type: 'delete'
                        , success: function(data) { //jika sukses
                            setTimeout(function() {
                                var oTable = $('#data_table').dataTable();
                                oTable.fnDraw(false); //reset datatable
                                $('#tombol-hapus').text('Yakin');
                            });
                        }
                    });
                    alertify.success('Data berhasil dihapus');
                }, function() {
                    alertify.error('Cancel');
                });
            });
        @endif


    });

</script>
@stop

