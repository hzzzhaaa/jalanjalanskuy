@extends('attendee/partials/app')

@section('style')
<link href="{{asset('assets/pages/css/blog.min.css')}}" rel="stylesheet" type="text/css" />
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
                                <h1>Discover Events
                                    <small>Find your interest here!</small>
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
                                    <span>Event</span>
                                </li>
                            </ul>
                            <!-- END PAGE BREADCRUMBS -->
                            <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="page-content-inner">
                                <div class="blog-page blog-content-1">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div style="text-align:center"><h2><strong>Coming Events</h2></div><br>
                                                    @foreach($events->where('publish',1) as $event)
                                                <div class="col-sm-3">
                                                    <div class="blog-post-sm bordered blog-container">
                                                        <div style="text-align:center; background-color:white">
                                                            <a href="javascript:;">
                                                            <img src="{{asset('storage/upload/'.$event->image)}}" width="200" height="300" style="padding:10px"/>
                                                            </a>
                                                        </div>
                                                        <div class="blog-post-content">
                                                            <h2 class="blog-title blog-post-title" style="text-align:center">
                                                                <a href="javascript:;">{{$event->name}}</a>
                                                            </h2>
                                                            <div class="blog-post-desc1">
                                                                @markdown{{$event->description}}@endmarkdown
                                                            </div>
                                                            <div class="blog-post-foot">
                                                                <div class="blog-post-meta">
                                                                    <i class="icon-calendar font-blue"></i>
                                                                    <a href="javascript:;">{{DateTime::createFromFormat('Y-m-d',$event->date)->format('l, d F Y')}}</a>
                                                                </div>
                                                                <div class="blog-post-meta">
                                                                    <i class="icon-home font-blue"></i>
                                                                    <a href="javascript:;">{{$event->location}}</a>
                                                                </div><br><br>
                                                                <div style="text-align:center">
                                                                    <a class="btn btn-info" href="{{route('attendee.event.show',['event'=>Hashids::connection(\App\Event::class)->encode($event->id)])}}">See More</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                           </div>
                                        </div>
                                    </div>
                            <!-- END PAGE CONTENT INNER -->
                                </div>
                            </div>
                        </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                 </div>
                <!-- END CONTENT -->
                </div>
            </div>
         </div>
    </div>
</div>
@endsection
