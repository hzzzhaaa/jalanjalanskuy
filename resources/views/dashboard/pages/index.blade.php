@extends('dashboard/app')

@section('title')
 | Dashboard
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!--  BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-circle"></i>
                    <a href="#">Dashboard</a>
                </li>
            </ul>
        </div>
        <!--  END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title" style="color:steelblue"> <b>Hello, {{Auth::user()->name}}!</b></h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        {{-- <div class="portlet-body">
            <div class="mt-element-card mt-element-overlay">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="mt-card-item">
                            <div class="mt-card-avatar mt-overlay-1">
                                <img src="../../img/dummies/blog/thumbs/img4.jpg" width="100px" height="100px" />
                            </div>
                            <div class="mt-card-content">
                                <h3 class="mt-card-name">BINER</h3>
                                <p class="mt-card-desc font-grey-mint">
                                    <ul style="text-align:left;">
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="mt-card-item">
                            <div class="mt-card-avatar mt-overlay-1">
                                <img src="../../img/dummies/blog/thumbs/small1.jpg" width="100px" height="100px" />
                            </div>
                            <div class="mt-card-content">
                                <h3 class="mt-card-name">BINER</h3>
                                <p class="mt-card-desc font-grey-mint">
                                    <ul style="text-align:left;">
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="mt-card-item">
                                <div class="mt-card-avatar mt-overlay-1">
                                    <img src="../../img/dummies/blog/thumbs/img4.jpg" width="100px"  height="100px" />
                                </div>
                                <div class="mt-card-content">
                                    <h3 class="mt-card-name">BINER</h3>
                                    <p class="mt-card-desc font-grey-mint">
                                        <ul style="text-align:left;">
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="mt-card-item">
                                <div class="mt-card-avatar mt-overlay-1">
                                    <img src="../../img/dummies/blog/thumbs/small1.jpg" width="100px" height="100px" />
                                </div>
                                <div class="mt-card-content">
                                    <h3 class="mt-card-name">BINER</h3>
                                    <p class="mt-card-desc font-grey-mint">
                                        <ul style="text-align:left;">
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                            <li><b>Tiket VVIP</b><br>terjual = 10 dari 100</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div> --}}
    <!-- END CONTENT BODY -->
    </div>
</div>
@endsection
