@extends('attendee/partials/app')

@section('style')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/apps/css/ticket.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
@endsection

@section('content')
<div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <div class="container">
                            <!-- BEGIN PAGE TITLE -->
                            <div class="page-title">
                                <h1>Event Description
                                </h1>
                            </div>
                            <!-- END PAGE TITLE -->
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE CONTENT BODY -->
                    <div class="page-content">
                        <div class="container">
                            <!-- BEGIN PAGE BREADCRUMBS -->
                            <ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <a href="/">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <a href="/event">Event</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Event Description</span>
                                </li>
                            </ul>
                            <!-- END PAGE BREADCRUMBS -->
                            <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="page-content-inner">
                                <div class="profile">
                                    <div class="tabbable-line tabbable-full-width">
                                        <div class="tab-content">
                                            <div class="tab-pane active">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <ul class="list-unstyled profile-nav">
                                                            <li>
                                                                <img src="{{asset('storage/upload/'.$event->image)}}" class="img-responsive pic-bordered" alt="" height="200" width="300"/>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-8 profile-info">
                                                                <h1 class="font-green sbold uppercase" style="text-align:center">{{$event->name}}</h1>
                                                               <p> @markdown{{$event->description}}@endmarkdown</p>
                                                                    <a>
                                                                        <i class="fa fa-map-marker"></i> {{$event->location}} </a><br><br>
                                                                    <a>
                                                                        <i class="fa fa-calendar"></i> {{DateTime::createFromFormat('Y-m-d',$event->date)->format('l, d F Y')}} </a><br><br>
                                                                        @if($event->tickets->first() !=null)
                                                                    <a>
                                                                        @if($event->tickets->count() >1)
                                                                        <i class="fa fa-money"></i> Rp {{number_format($event->tickets->sortBy('price')->first()->price,2,',','.')}} - Rp {{number_format($event->tickets->sortBy('price')->last()->price,2,',','.')}} </a><br><br>
                                                                        @else
                                                                        <i class="fa fa-money"></i> Rp {{number_format($event->tickets->first()->price,2,',','.')}} </a><br><br>
                                                                        @endif
                                                                        @endif
                                                                <div style="text-align:center">
                                                                        @if($event->tickets->first() !=null)
                                                                <a class="btn btn-md btn-success" data-target="#buy" data-toggle="modal"><i class="icon-plus"></i>&nbsp;Book Ticket</a></div>
                                                                @else
                                                                <a class="btn btn-md btn-danger" >Unavailable</a></div>
                                                                @endif
                                                            </div>
                                                            <!--end col-md-8-->
                                                            <div class="col-md-2">
                                                                <!-- BEGIN PROFILE SIDEBAR -->
                                                                <div class="profile-sidebar">
                                                                        <!-- PORTLET MAIN -->
                                                                        <div class="portlet light profile-sidebar-portlet ">

                                                                            <!-- SIDEBAR USER TITLE -->
                                                                            <h3 class="font-green sbold uppercase" style="text-align:center">Organizer</h3>
                                                                            <!-- END SIDEBAR USER TITLE -->
                                                                            <!-- SIDEBAR USERPIC -->
                                                                            <div class="profile-usertitle">
                                                                            <img src="{{asset('/storage/upload/' .$event->organizer->picture)}}" height="210" width="180"> </div>
                                                                            <!-- END SIDEBAR USERPIC -->
                                                                            <!-- SIDEBAR USER TITLE -->
                                                                            <div class="profile-usertitle">
                                                                                <div class="profile-usertitle-name"> {{$event->organizer->name}} </div>
                                                                            </div>
                                                                            <!-- END SIDEBAR USER TITLE -->
                                                                            <!-- SIDEBAR BUTTONS -->
                                                                            <div class="profile-userbuttons">
                                                                                {{-- <button type="button" class="btn btn-circle green btn-sm">Follow</button> --}}
                                                                                <a href="{{route('attendee.organizer.show',['organizer'=>Hashids::connection(\App\Organizer::class)->encode($event->organizer->id)])}}" type="button" class="btn btn-circle red btn-sm" href="">Visit</a>
                                                                            </div>
                                                                            <!-- END SIDEBAR BUTTONS -->

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end col-md-4-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE CONTENT INNER -->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
        </div>
    </div>

    <!-- stackable -->
    <div id="buy" class="modal fade" tabindex="-1" data-focus-on="input:first">
        <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title"><strong>Select Ticket</strong></h4>
        </div>
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
            @foreach($event->tickets->where('onsale',1) as $ticket)
            <div class="row" style="text-align:center">
                <div class="col-md-4">
                    <a style="color:black">{{$ticket->name}}</a>
                </div>
                <div class="col-md-4">
                    <a style="color:black">Rp {{number_format($ticket->price,2,',','.')}}</a>
                </div>
                <div class="col-md-4">
                    @if($ticket->limit != null && $ticket->users->count() == $ticket->limit)
                    <a href="javascript:;" class="btn red">Habis</a>
                    @else
                    <a href="" onclick="event.preventDefault();buy('ticket' + {{$ticket->id}})" class="btn blue">Choose</a>
                    {!! Form::open(['route' =>['attendee.book.ticket','ticket'=>Hashids::connection(\App\Ticket::class)->encode($ticket->id)],
                        'id'=>'ticket'.$ticket->id,'style'=>'display:none']) !!}
                    {!! Form::close() !!}
                    @endif
                </div>
            </div><br>
            @endforeach
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
<script src="{{asset('sweetalert2/sweetalert2.all.min.js')}}" type="text/javascript"></script>
<script>
function buy(form) {

    $('#buy .close').click();
    Swal.fire({
            title: 'Booking',
            text: 'Are you sure ?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Book!'
        }).then((result) => {
            if (result.value) {
                $('#' + form).submit();
            }
        });
}</script>
@endsection
