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
                    <h4 class="page-title">Barang Keluar <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button></h4>

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
                                    <th>Jumlah Barang</th>
                                    <th>File Surat</th>
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
            , ajax: "{{ route(auth()->user()->role.'_barangkeluar') }}"

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
                    data: 'jml_barang'
                    , name: 'jml_barang'
                }
                , {
                    data: 'file_surat'
                    , name: 'file_surat'
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
                    var form = $("#form-tambah-edit")[0];
                    var data = new FormData(form);
                    $.ajax({
                        type: "POST", //karena simpan kita pakai method POST
                        enctype: "multipart/form-data"
                        , url: "{{ route(auth()->user()->role.'_barangkeluarcreate') }}", //url simpan data

                        data: data, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        processData: false
                        , contentType: false
                        , cache: false
                        , timeout: 600000
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
            var url = "{{ route(auth()->user()->role.'_barangkeluardelete', ':dataid') }}";
            urls = url.replace(':dataid', dataid);
            alertify.confirm('Seluruh data yang berkaitan pada barang keluar ini akan ikut terhapus, apa anda yakin ?', function() {

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

