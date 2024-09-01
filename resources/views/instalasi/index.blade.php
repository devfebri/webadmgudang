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
                    <h4 class="page-title">Pengajuan Instalasi <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button></h4>

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
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Serial Number</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Item</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <select class="form-control" name="jenis" required>
                                    <option value="">-pilih-</option>
                                    <option value="ONT">ONT</option>
                                    <option value="STB">STB</option>
                                    <option value="STB">STB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Owner</label>
                                <input type="text" name="owner" id="owner" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">-pilih-</option>
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
            , ajax: "{{ route(auth()->user()->role.'_instalasi') }}"
            , columns: [{
                    data: null
                    , sortable: false
                    , render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                , }
                , {
                    data: 'nama_paket'
                    , name: 'nama_paket'
                }
                , {
                    data: 'nomor_internet'
                    , name: 'nomor_internet'
                }
                , {
                    data: 'harga'
                    , name: 'harga'
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

        


    });

</script>
@stop

