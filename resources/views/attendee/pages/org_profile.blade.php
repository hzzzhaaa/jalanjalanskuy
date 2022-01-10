@extends('attendee/partials/app')

@section('style')
<link href="{{asset('assets/pages/css/blog.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/apps/css/ticket.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />
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
                                <h1>Organizer Description
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
                                    <a href="index-2.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <a href="#">Event</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Organizer Detail</span>
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
                                                        <!-- BEGIN PROFILE SIDEBAR -->
                                                        <div class="profile-sidebar">
                                                                <!-- PORTLET MAIN -->
                                                                <div class="portlet light profile-sidebar-portlet ">
                                                                    <!-- SIDEBAR USERPIC -->
                                                                    <div class="profile-userpic">
                                                                        <img src="{{asset('storage/upload/'.$organizer->picture)}}" class="img-responsive" alt=""> </div>
                                                                    <!-- END SIDEBAR USERPIC -->
                                                                    <!-- SIDEBAR USER TITLE -->
                                                                    <div class="profile-usertitle">
                                                                        <div class="profile-usertitle-name"> {{$organizer->name}} </div>
                                                                    </div>
                                                                    <!-- END SIDEBAR USER TITLE -->
                                                                    <!-- SIDEBAR BUTTONS -->
                                                                    <div class="profile-userbuttons">
                                                                        {{-- <button type="button" class="btn btn-circle green btn-sm">Follow</button> --}}
                                                                    </div>
                                                                    <!-- END SIDEBAR BUTTONS -->
                                                            </div>
                                                        </div>
                                                        <!-- END PROFILE SIDEBAR -->
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="profile-info">
                                                               @markdown{{$organizer->description}}@endmarkdown
                                                            </div>
                                                            <!--end col-md-8-->
                                                            <!--end col-md-4-->
                                                        </div>
                                                        <!--end row-->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h3>&nbsp; &nbsp; <strong>Events held by {{$organizer->name}}</strong></h3></div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        {{-- {{dd($organizer->events->take(4))}} --}}
                                                        @foreach($organizer->events->take(4) as $event)
                                                        <div class="col-sm-3 blog-page blog-content-1">
                                                            <div class="blog-post-sm bordered blog-container">
                                                                <div class="blog-img-thumb">
                                                                    <a href="javascript:;">
                                                                        <img src="{{asset('storage/upload/'.$event->image)}}" />
                                                                    </a>
                                                                </div>
                                                                <div class="blog-post-content">
                                                                    <h2 class="blog-title blog-post-title">
                                                                        <a href="javascript:;">{{$event->name}}</a>
                                                                    </h2>
                                                                    <p class="blog-post-desc"> Lorem ipsum dolor sit amet adipiscing elit, sed diam nonummy </p>
                                                                    <a href="{{route('attendee.event.show',['event'=> Hashids::connection(\App\Event::class)->encode($event->id)])}}"><strong>See More</strong></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
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
@endsection

@section('style')
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
@endsection
