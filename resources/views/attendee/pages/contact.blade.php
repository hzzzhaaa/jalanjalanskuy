@extends('attendee/partials/app')

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
                                        <h1>Contact Us
                                            <small>contact us page</small>
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
                                            <a href="#">Pages</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>General</span>
                                        </li>
                                    </ul>
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        <div class="c-content-feedback-1 c-option-1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="c-contact">
                                                        <div class="c-content-title-1">
                                                            <h3 class="uppercase">Keep in touch</h3>
                                                            <div class="c-line-left bg-dark"></div>
                                                            <p class="c-font-lowercase">Our helpline is always open to receive any inquiry or feedback. Please feel free to drop us an email from the form below and we will get back to you as soon as we can.</p>
                                                        </div>
                                                        <form action="#">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Your Name" class="form-control input-md"> </div>
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Your Email" class="form-control input-md"> </div>
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Contact Phone" class="form-control input-md"> </div>
                                                            <div class="form-group">
                                                                <textarea rows="8" name="message" placeholder="Write comment here ..." class="form-control input-md"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn grey">Submit</button>
                                                        </form>
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
