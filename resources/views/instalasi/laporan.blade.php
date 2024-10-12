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
                    <h4 class="page-title">Item
                        <button id="btntambah" class="btn btn-primary float-right">Tambah Data</button>
                    </h4>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" method="POST" action="{{ route('admin_instalasidownload') }}" target="_blank">
                            @csrf
                            <div class="row">

                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                                    </div>


                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">download</button>
                                </div>


                            </div>

                        </form>

                    </div>
                </div>
            </div>
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

@stop

