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
                    <h4 class="page-title">Item <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button></h4>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Item</th>
                                    <th>Sarial Number</th>
                                    <th>Type</th>
                                    <th>Jenis</th>
                                    <th>Owner</th>
                                    <th>Suplier</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>200NTZTE02</td>
                                    <td>0NT_ZTE_F670L</td>
                                    <td>ZTEGD4ABBDA0</td>
                                    <td></td>
                                    <td><span class="badge badge-pill badge-success"><b><i>INSTAL</i></b></span></td>
                                    <td><span class="badge badge-pill badge-success"><b><i>INSTAL</i></b></span></td>

                                    <td>
                                        <button class="tabledit-edit-button btn btn-sm btn-warning edit-post"  id="alertify-success" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>
                                        <button class="tabledit-delete-button btn btn-sm btn-danger delete" style="float: none; margin: 5px;"><span class="ti-trash"></span></button>
                                    </td>

                                </tr>
                            </tbody> --}}
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
            <form class="needs-validation" id="form-tambah-edit" name="form-tambah-edit" >
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">

                        <div class="col-sm-6 col-lg-12">
                            <div class="form-group">
                                <label>Product Code</label>
                                <input type="text" name="product_code" id="product_code" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <input type="text" name="product_description" id="product_description" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Serial Number</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>SID</label>
                                <input type="text" name="sid" id="sid" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option>Select</option>
                                    <option value="Instal">Instal</option>
                                    <option value="Intech">Intech</option>
                                </select>
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
            var table = $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route(auth()->user()->role.'_item') }}",
            columns: [{
                    data: null,
                    sortable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    },
                },

                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'serial_number',
                    name: 'serial_number'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },

                {
                    data: 'owner',
                    name: 'owner'
                },
                {
                    data: 'supplier',
                    name: 'supplier'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
            $('#btntambah').on('click', function() {
                $('#tambah-edit-modal').modal('show');
            });
            if ($("#form-tambah-edit").length > 0) {

                $("#form-tambah-edit").validate({
                    submitHandler: function(form) {
                        var simpan = $('#tombol-simpan').html('Sending..');

                        var form = $("#form-tambah-edit")[0];
                        var data = new FormData(form);
                        $.ajax({
                            type: "POST", //karena simpan kita pakai method POST
                            enctype: "multipart/form-data"
                            , url: "{{ route(auth()->user()->role.'_itemcreate') }}", //url simpan data
                            data: data, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                            // processData: false,
                            // contentType: false,
                            // cache: false,
                            // timeout: 600000,
                            success: function(data) { //jika berhasil
                                alert('ok');
                            }
                            , error: function(data) { //jika error tampilkan error pada console
                                $('#tombol-simpan').html('Simpan');
                            }
                        });

                    }
                })
            }

        });

    </script>

@stop

