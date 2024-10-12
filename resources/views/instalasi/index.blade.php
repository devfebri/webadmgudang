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
                    <h4 class="page-title">Pengajuan Instalasi
                        @if(auth()->user()->role=='admin')
                        <button id="btntambah" class="btn btn-primary float-right ml-2">Tambah Data</button>
                        @endif
                        <a href="{{ route('admin_instalasilaporan') }}" class="btn btn-primary float-right">Laporan</a>


                    </h4>

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
                                    <th>No Instalasi</th>
                                    <th>Nama Consumen</th>
                                    <th>Nama Paket</th>
                                    <th>Nomor Internet</th>
                                    <th>Harga</th>
                                    <th>Layanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                <label>Layanan</label>
                                <select class="form-control" name="layanan" id="layanan" required>
                                    <option value="">-pilih-</option>
                                    <option value="Pasang Baru">Pasang Baru</option>
                                    <option value="Gangguan">Gangguan</option>
                                    <option value="Up Layanan">Up Layanan</option>
                                </select>
                            </div>
                            <div class="form-group" id="fpaket" style="display: none;">
                                <label>Paket</label>
                                <select class="form-control select2" name="paket" id='paket' >
                                    <option value="">-pilih-</option>
                                    @foreach ($paket as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_paket }} - Rp {{ number_format($row->harga,0) }}/month </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" >
                                <label>Consumen</label>
                                <select class="form-control select2" name="consumen_id" id="consumen_id">
                                    <option value="">-pilih-</option>
                                    @foreach ($consumen as $row1)
                                    <option value="{{ $row1->id }}">{{ $row1->nama }} - {{ $row1->no_hp }}  </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="fno_internet" style="display: none;">
                                <label>Nomor Internet</label>
                                <input type="text" name="no_internet" id="no_internet" class="form-control" >
                            </div>
                             <div class="form-group" id="fdeskripsi" style="display: none;">
                                 <label>Deskripsi</label>
                                 <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
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

        $('#layanan').on('change',function(){
            var value=$(this).val();
            // alert(value);
            if(value=='Pasang Baru'){
                $('#fpaket').show();
                $('#fdeskripsi').hide();
                $('#fno_internet').hide();
                 $("#deskripsi").prop('required',false);
                 $("#no_internet").prop('required',false);
                 $("#paket").prop('required',true);

            }else if(value=='Gangguan'){
                $('#fdeskripsi').show();
                $('#fno_internet').show();
                $("#deskripsi").prop('required',true);
                $("#no_internet").prop('required',true);
                $("#paket").prop('required',false);

                $('#fpaket').hide();
            }else if(value=='Up Layanan'){
                $('#fdeskripsi').show();
                $('#fno_internet').show();
                $("#deskripsi").prop('required',true);
                $("#no_internet").prop('required',true);
                $("#paket").prop('required',true);
                $('#fpaket').show();

            }

        });
        var table = $('#data_table').DataTable({
            processing: true
            , serverSide: true
            ,scrollX: true
            , ajax: "{{ route(auth()->user()->role.'_instalasi') }}"
            , columns: [{
                    data: null
                    , sortable: false
                    , render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                , }
                , {
                    data: 'kode_instalasi'
                    , name: 'kode_instalasi'
                }
                , {
                    data: 'nama_consumen'
                    , name: 'nama_consumen'
                }
                , {
                    data: 'nama_paket'
                    , name: 'nama_paket'
                }
                , {
                    data: 'nomor_internet'
                    , name: 'nomor_internet'
                }
                , {
                    data: 'harga_paket'
                    , name: 'harga_paket'
                }
                , {
                    data: 'layanan'
                    , name: 'layanan'
                }

                , {
                    data: 'status'
                    , name: 'status'
                }
                , {
                    data: 'action'
                    , name: 'action'
                }
            ]
        });
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
                        url: "{{ route(auth()->user()->role.'_instalasicreate') }}", //url simpan data
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
            var url = "{{ route(auth()->user()->role.'_instalasidelete', ':dataid') }}";

            urls = url.replace(':dataid', dataid);
            alertify.confirm('Seluruh data yang berkaitan pada instalasi ini akan ikut terhapus, apa anda yakin ?', function() {
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
        })






    });

</script>
@stop

