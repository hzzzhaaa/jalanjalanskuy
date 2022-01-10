@extends('dashboard/app')

@section('title')
 | {{$organizer->name}}
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="col-md-6">
                <h2 style="color:steelblue"><strong>Organizer Profile</strong></h2>
            </div>
            <div class="col-md-6" style="text-align:right">
                <br>
            <a href="{{route('dashboard.organizer.edit',['organizer'=>Hashids::connection(\App\Organizer::class)->encode($organizer->id)])}}" class="btn btn-large btn-info"><strong>Edit</strong></a>
            </div><br><br><br>

            <div class="page-title"></div>
            <!-- END PAGE TITLE-->
        <!-- BEGIN PAGE TITLE-->
        <div class="profile">
                <div class="tabbable-line tabbable-full-width">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="row">
                                <div class="col-md-3" style="text-align:center;">
                                    <p style="color:white">aaaaaa</p>
                                <img src="{{asset('/storage/upload/'.$organizer->picture)}}" width="50%"/>
                                </div>
                                <div>
                                    <div class="row" style="text-align:center">
                                        <div class="col-md-8 profile-info">
                                            <h3 class="font-green sbold uppercase">{{$organizer->name}}</h3>
                                            @markdown{{$organizer->description}}@endmarkdown
                                                {{-- <li>
                                                    <i class="fa fa-calendar"></i> 18 January 2014 </li>
                                                <li>
                                                    <i class="fa fa-briefcase"></i> Design </li>
                                                <li>
                                                    <i class="fa fa-star"></i> Top Seller </li>
                                                <li>
                                                    <i class="fa fa-heart"></i> BASE Jumping </li> --}}
                                            </ul>
                                        </div>
                                        <!--end col-md-8-->
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
</div>
@endsection
