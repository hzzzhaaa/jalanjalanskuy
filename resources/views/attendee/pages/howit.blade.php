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
                                <h1>How It Works
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
                                    <span>How It Works</span>
                                </li>
                            </ul>
                            <!-- END PAGE BREADCRUMBS -->
                            <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="page-content-inner">
                                <div class="blog-page blog-content-1">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="blog-post-sm bordered blog-container">
                                                            <div class="blog-img-thumb">
                                                                <a href="javascript:;">
                                                                    <img src="{{asset('img/attendee.jpg')}}" />
                                                                </a>
                                                            </div>
                                                            <div class="blog-post-content" style="text-align: center">
                                                                <h2 class="blog-title blog-post-title">
                                                                    <a href="javascript:;">For Attendee</a>
                                                                </h2>
                                                                <ul class="list-number">
                                                                    <li>
                                                                        <p class="blog-post-desc">Start</p>
                                                                        <img src="{{asset('images/howto/attendee/halamandepan.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Kalian bisa milih event dibagian Our Top event</p>
                                                                        <img src="{{asset('images/howto/attendee/ourtopevent.jpg')}}" height="50%" width="50%">
                                                                        <p class="blog-post-desc">Atau kalian masuk ke menu event</p>
                                                                        <img src="{{asset('images/howto/attendee/eventmenu.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Setelah di klik eventnya akan muncul event profile</p>
                                                                        <img src="{{asset('images/howto/attendee/eventdesc.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Setelah itu klik book now, lalu pilih tiket yang akan dibeli dan klik book untuk memesan ticket</p>
                                                                        <img src="{{asset('images/howto/attendee/listticket.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Nah kalian akan diredirect ke mytickets</p>
                                                                        <img src="{{asset('images/howto/attendee/myticket.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Lalu kamu harus upload bukti pembayaran</p>
                                                                        <img src="{{asset('images/howto/attendee/uploadbukti.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Nahh.. sekarang tinggal menunggu pesanan di approve sama empunya acara</p>
                                                                        <img src="{{asset('images/howto/attendee/sesudahuploadbukti.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Empunya acara udah nge-approve nehhh... kamu klik see ticket buat liat qrcode tiket kamu</p>
                                                                        <img src="{{asset('images/howto/attendee/sesudahdiapprove.jpg')}}" height="50%" width="50%">
                                                                        <p class="blog-post-desc">Nahhhh..... nanti kamu simpen buat ditunjukin ke penerima tamu buat di check in</p>
                                                                        <img src="{{asset('images/howto/attendee/qr.jpg')}}" height="50%" width="50%">
                                                                    </li>
                                                                    <li style="text-align:center">
                                                                        <p class="blog-post-desc">Tiket kamu juga dikirim ke email kamu, jadi kamu bisa liat qr codenya dari email juga</p>
                                                                        <img src="{{asset('images/howto/attendee/ticketemail.jpg')}}" height="50%" width="50%">
                                                                    </li>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="blog-post-sm bordered blog-container">
                                                            <div class="blog-img-thumb">
                                                                <a href="javascript:;">
                                                                    <img src="{{asset('img/organizer.jpeg')}}" />
                                                                </a>
                                                            </div>
                                                            <div class="blog-post-content">
                                                                <h2 class="blog-title blog-post-title">
                                                                    <a href="javascript:;">For Organizer</a>
                                                                </h2>
                                                                <p class="blog-post-desc"> Lorem ipsum dolor sit amet adipiscing elit, sed diam nonummy </p>
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
                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
</div>
@endsection
