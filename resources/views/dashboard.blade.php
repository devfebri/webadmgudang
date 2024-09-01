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


                         <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                             <div class="carousel-inner" role="listbox">
                                 <div class="carousel-item active">
                                     <img class="d-block img-fluid" src="{{ asset('img/1.jpg') }}" style="width: 100%"  alt="First slide">
                                 </div>
                                 <div class="carousel-item">
                                     <img class="d-block img-fluid" src="{{ asset('img/2.jpg') }}" style="width: 100%" alt="Second slide">
                                 </div>
                             </div>
                             <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Previous</span>
                             </a>
                             <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Next</span>
                             </a>
                         </div>
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

