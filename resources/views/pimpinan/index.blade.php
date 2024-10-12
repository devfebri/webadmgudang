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
                    <h4 class="page-title">Pimpinan <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button></h4>

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
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TTL</th>
                                    <th>Alamat</th>
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
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="number" name="nik" id="nik" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor HP</label>
                                <input type="number" name="no_hp" id="no_hp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control " name="jk" id="jk" required>
                                    <option value="">-pilih-</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
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
            , ajax: "{{ route(auth()->user()->role.'_pimpinan') }}"
            , columns: [{
                    data: null
                    , sortable: false
                    , render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                , }
                , {
                    data: 'nik'
                    , name: 'nik'
                }
                , {
                    data: 'nama'
                    , name: 'nama'
                }
                , {
                    data: 'no_hp'
                    , name: 'no_hp'
                }
                , {
                    data: 'jk'
                    , name: 'jk'
                }
                , {
                    data: 'ttl'
                    , name: 'ttl'
                }
                , {
                    data: 'alamat'
                    , name: 'alamat'
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
            $('#no_hp').attr('disabled',false);


        });
        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function(form) {
                    var actionType = $('#tombol-simpan').val();
                    var simpan = $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route(auth()->user()->role.'_pimpinancreate') }}", //url simpan data
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
            var url = "{{ route(auth()->user()->role.'_pimpinandelete', ':dataid') }}";

            urls = url.replace(':dataid', dataid);
            alertify.confirm('Seluruh data yang berkaitan di pimpinan ini akan ikut terhapus, apa anda yakin ?', function() {
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
        $('body').on('click', '.edit-post', function () {
             var data_id = $(this).data('id');
             var url = "{{ route(auth()->user()->role.'_pimpinanedit',':data_id') }}";
             url = url.replace(':data_id', data_id);
            $.get(url, function (data) {
                $('#modal-judul').html("Edit pimpinan");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');
                $('#id').val(data.pimpinan.id);
                $('#nama').val(data.pimpinan.nama);
                $('#nik').val(data.pimpinan.nik);
                $('#no_hp').val(data.pimpinan.no_hp);
                $('#no_hp').attr('disabled',true);
                $('#jk').val(data.pimpinan.jk).change();
                $('#tmpt_lahir').val(data.pimpinan.tmpt_lahir);
                $('#tgl_lahir').val(data.tgl_lahir);
                $('#alamat').val(data.pimpinan.alamat);
            })
        });


    });

</script>
@stop

