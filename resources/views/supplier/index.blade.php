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
                    <h4 class="page-title">Supplier
                         @if(auth()->user()->role=='admin')
                        <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button>
                        @endif
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
                                    <th>No Surat</th>
                                    <th>Nama Supplier</th>
                                    <th>Nama Penerima</th>
                                    <th>Nama Pengirim</th>
                                    <th>type</th>
                                    <th>Jumlah Barang</th>
                                    <th>File Surat</th>
                                    @if(auth()->user()->role=='admin')
                                    <th >Aksi</th>
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
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>No Surat</label>
                                <input type="number" name="no_surat" id="no_surat" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Penerima</label>
                                <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Pengirim</label>
                                <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required>
                            </div>

                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label>Type</label>
                            <select class="form-control select2" name="type" required>
                                <option value="">-pilih-</option>
                                <option value="ONT_HUAWEI_HG8145V5">ONT_HUAWEI_HG8145V5</option>
                                <option value="ONT_FIBERHOME_HG6245N">ONT_FIBERHOME_HG6245N</option>
                                <option value="ONT_ZTE_F670 V2.0">ONT_ZTE_F670 V2.0</option>
                                <option value="SetTopBoxIPTV_FIBERHOME_HG680FJ">SetTopBoxIPTV_FIBERHOME_HG680FJ</option>
                                <option value="SetTopBoxIPTV_FIBERHOME_HG680-P">SetTopBoxIPTV_FIBERHOME_HG680-P</option>
                                <option value="SetTopBox_ZTE_B860H_V5.0">SetTopBox_ZTE_B860H_V5.0</option>
                                <option value="ORBIT_SS_ZTE_K10_STAR_Z2"> ORBIT_SS_ZTE_K10_STAR_Z2</option>
                                <option value="ORBIT_SS ex ROUTER_HKM0128a">ORBIT_SS ex ROUTER_HKM0128a</option>
                                <option value="ONT_FIBERHOME_HG6243C">ONT_FIBERHOME_HG6243C</option>
                                <option value="ONT_FIBERHOME_HG6145F">ONT_FIBERHOME_HG6145F</option>
                                <option value="ONT_HUAWEI_HG8245A">ONT_HUAWEI_HG8245A</option>
                                <option value="ONT_ZTE_F609_V5.3">ONT_ZTE_F609_V5.3</option>
                                <option value="ONT_ZTE_F670L">ONT_ZTE_F670L</option>
                                <option value="SetTopBoxIPTV_ZTE_B860H_V2.1"> SetTopBoxIPTV_ZTE_B860H_V2.1</option>
                                <option value="SetTopBoxIPTV_ZTE_B860H"> SetTopBoxIPTV_ZTE_B860H</option>
                                <option value="SetTopBox_ZTE_ZX10_B866F_V1.1"> SetTopBox_ZTE_ZX10_B866F_V1.1</option>
                                <option value="ONT_HUAWEI_HG8245H5">ONT_HUAWEI_HG8245H5</option>
                                <option value="ONT_HUAWEI_HG8245H">ONT_HUAWEI_HG8245H</option>
                                <option value="ONT_HUAWEI_HG8245"> ONT_HUAWEI_HG8245</option>
                                <option value="ONT_FIBERHOME_HG6145D2">ONT_FIBERHOME_HG6145D2</option>
                                <option value="ONT_ZTE_F609">ONT_ZTE_F609</option>
                                <option value="SetTopBoxIPTV_ZTE_B760H">SetTopBoxIPTV_ZTE_B760H</option>
                                <option value="ONT_ZTE_F670"> ONT_ZTE_F670</option>
                                <option value="ONT_ZTE_F660">ONT_ZTE_F660</option>
                                <option value="TYPE">TYPE</option>
                            </select>

                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" name="jml_barang" id="jml_barang" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>File Surat</label>
                                <input type="file" name="file_surat" id="file_surat" class="form-control" required>
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
            , ajax: "{{ route(auth()->user()->role.'_supplier') }}"
            , columns: [{
                    data: null
                    , sortable: false
                    , render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                , }
                , {
                    data: 'no_surat'
                    , name: 'no_surat'
                }
                , {
                    data: 'nama_supplier'
                    , name: 'nama_supplier'
                }
                , {
                    data: 'nama_penerima'
                    , name: 'nama_penerima'
                }
                , {
                    data: 'nama_pengirim'
                    , name: 'nama_pengirim'
                }
                , {
                    data: 'type'
                    , name: 'type'
                }
                , {
                    data: 'jml_barang'
                    , name: 'jml_barang'
                }
                , {
                    data: 'file_surat'
                    , name: 'file_surat'
                }
                @if(auth()->user()->role=='admin')
                , {
                    data: 'action'
                    , name: 'action'
                }
                @endif
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
                    var form = $("#form-tambah-edit")[0];
                    var data = new FormData(form);
                    $.ajax({
                        type: "POST", //karena simpan kita pakai method POST
                        enctype: "multipart/form-data",
                        url: "{{ route(auth()->user()->role.'_suppliercreate') }}", //url simpan data
                        data: data, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) { //jika berhasil
                            $('#form-tambah-edit').trigger("reset"); //form
                            $('#tambah-edit-modal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#data_table')
                                .dataTable(); //inialisasi datatable
                            oTable.fnDraw(false);
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }

        $('body').on('click', '.delete', function(id) {
            var dataid = $(this).attr('data-id');
            var url = "{{ route(auth()->user()->role.'_supplierdelete', ':dataid') }}";
            urls = url.replace(':dataid', dataid);
            alertify.confirm('Seluruh data yang berkaitan di supplier ini akan ikut terhapus, apa anda yakin ?', function() {
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
    });

</script>
@stop

