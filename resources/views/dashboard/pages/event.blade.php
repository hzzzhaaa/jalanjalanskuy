@extends('dashboard/app')

@section('title')
| {{$event->name}}
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
            @include('dashboard/partials/_messages')
        <!-- BEGIN PAGE HEADER-->
        <div class="col-md-6">
            <h1 style="color:steelblue"><strong>Event Profile</strong></h1>
        </div>
        <div class="col-md-6" style="text-align:right">
            <br>
        <a href="{{route('dashboard.event.edit',['event' => Hashids::connection(\App\Event::class)->encode($event->id)])}}" class="btn btn-large btn-info"><strong>Edit</strong></a>
        {{-- <a href="javascript:;" onclick="event.preventDefault();$('#finishForm').submit()"class="btn btn-large btn-warning"><strong>Finish</strong></a>
        {!! Form::open(['route'=> ['dashboard.event.finish','event'=>Hashids::connection(\App\Event::class)->encode($event->id)],'method'=>'POST','id'=>'finishForm','style'=>'display:none']) !!}
        {!! Form::close() !!} --}}

        {{-- <a href="javascript:;" onclick="event.preventDefault();$('#removeForm').submit()"class="btn btn-large btn-danger"><strong>Delete</strong></a>
        {!! Form::open(['route'=> ['dashboard.event.remove','event'=>Hashids::connection(\App\Event::class)->encode($event->id)],'method'=>'POST','id'=>'removeForm','style'=>'display:none']) !!}
        {!! Form::close() !!} --}}
        </div><br><br><br>

        <div class="page-title"></div>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="profile">
            <div class="tabbable-line tabbable-full-width">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="list-unstyled profile-nav">
                                    <li>
                                        <img src="{{asset('storage/upload/' . $event->image)}}" class="img-responsive pic-bordered" alt="" />
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8 profile-info">
                                    <h1 class="font-green sbold uppercase">{{$event->name}}</h1>

                                        @markdown{{$event->description}}@endmarkdown
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="fa fa-map-marker"></i>{{$event->location}}</li>
                                            <li>
                                                <i
                                                    class="fa fa-calendar"></i>{{DateTime::createFromFormat('Y-m-d', $event->date)->format('d-m-Y')}}
                                            </li>
                                            <li>
                                                <i class="fa fa-clock-o"></i>{{
                                                DateTime::createFromFormat('H:i:s', $event->timeStart)->format('H:i')
                                                }}
                                                {{$event->timeEnd != null ? ' - ' . DateTime::createFromFormat('H:i:s', $event->timeEnd)->format('H:i') : ''}}
                                            </li>
                                            @foreach ($event->paymentMethods as $method)
                                            <li>
                                                <i class="fa fa-credit-card"></i> {{$method->bank}}
                                                {{$method->bankAccountNumber}} a/n {{$method->bankAccountName}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!--end col-md-8-->
                                    {!! Form::open(['route'=> ['dashboard.event.hide','event'=> Hashids::connection(\App\Event::class)->encode($event->id)], 'style'=>'display:none','method'=>'POST','id'=>'hide']) !!}
                                    {!! Form::close() !!}
                                    {!! Form::open(['route'=> ['dashboard.event.publish','event'=> Hashids::connection(\App\Event::class)->encode($event->id)], 'style'=>'display:none','method'=>'POST','id'=>'publish']) !!}
                                    {!! Form::close() !!}
                                    @if($event->publish == 1)
                                    <div class="col-md-4">
                                        <div class="portlet sale-summary">
                                            <div class="portlet-title">
                                                <div class="caption font-navy sbold"> Status &nbsp;
                                                    <span class="label label-whote">Published</span>
                                                        <span class="label label-success">Published</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span> Unpublish this event
                                                        </span>&nbsp;
                                                        <a class="btn red" onclick="event.preventDefault();
                                                        document.getElementById('hide').submit();">
                                                             Hide </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <!--end col-md-4-->
                                    <!--end col-md-8-->
                                    <div class="col-md-4">
                                        <div class="portlet sale-summary">
                                            <div class="portlet-title">
                                                <div class="caption font-navy sbold"> Status &nbsp;
                                                    <span class="label label-whote">Publish</span>
                                                        <span class="label label-danger">Hidden</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span> Publish this event
                                                        </span>&nbsp;
                                                        <a href="" class="btn green" onclick="event.preventDefault();
                                                        document.getElementById('publish').submit();">
                                                             Publish </a>
                                                    </li>
                                                    <li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
</div>
<!-- END CONTENT BODY -->
@endsection

@section('style')
<link href="{{asset('assets/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

