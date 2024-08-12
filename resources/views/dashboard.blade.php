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

                     <h4 class="page-title">Dashboard</h4>
                 </div>
             </div>
         </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        dsadas
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

