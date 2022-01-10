<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head> @include('attendee/partials/head')
    <body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER -->
                <div class="page-header">
                    <!-- BEGIN HEADER TOP -->
                    <div class="page-header-top">
                        <div class="container">
                            <!-- BEGIN LOGO -->
                            <div class="page-logo">
                            <a href="{{route('index')}}">
                                    <img src="{{asset('img/logo.png')}}" class="logo-default" width="150">
                                </a>
                            </div>
                            <!-- END LOGO -->
                            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                            <a href="javascript:;" class="menu-toggler"></a>
                            <!-- END RESPONSIVE MENU TOGGLER -->
                            <!-- BEGIN TOP NAVIGATION MENU -->

                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <!-- BEGIN USER LOGIN DROPDOWN -->
                                    @guest
                                    <li class="dropdown dropdown-user dropdown-dark">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <img alt="" class="img-circle" src="{{asset('img/acc-1.png')}}"><span><i class="fa fa-arrow-down"></i></span>

                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-default">
                                            <li>
                                                <a href="/login">
                                                    <i class="icon-user"></i> Sign In </a>
                                            </li>
                                            <li>
                                                <a href="/register">
                                                    <i class="icon-user"></i> Sign Up </a>
                                            </li>
                                        </ul>
                                    </li>
                                    @else
                                    <li class="dropdown dropdown-user dropdown-dark">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <img alt="" class="img-circle" src="{{asset('img/acc-1.png')}}">
                                            <span class="username username-hide-mobile">{{Auth::user()->name}}</span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-default">
                                                <li>
                                                    <a href="/mytickets">
                                                        <i class="fa fa-ticket"></i> My Tickets </a>
                                                </li>
                                                <li>
                                                    @if(Auth::user()->isOrganizer() || Auth::user()->isAdmin())
                                                    <a href="{{route('dashboard')}}"><i class="icon-home"></i> Organizer Dashboard</a>
                                                    @else
                                                    <a data-toggle="modal" data-target="#exampleModalCenter"
                                                        href=""><i class="icon-home"></i>Organizer Dashboard</a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </li>
                                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                        <span class="sr-only">Toggle Quick Sidebar</span>
                                        <i class="icon-logout" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"></i>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                        </form>
                                    </li>
                                        <!-- END QUICK SIDEBAR TOGGLER -->
                                    @endguest
                                    <!-- END USER LOGIN DROPDOWN -->
                                </ul>
                            </div>
                            <!-- END TOP NAVIGATION MENU -->
                        </div>
                    </div>
                    <!-- END HEADER TOP -->
                    <!-- BEGIN HEADER MENU -->
                    <div class="page-header-menu">
                        <div class="container">
                            <!-- BEGIN MEGA MENU -->
                            <div class="hor-menu  ">
                                <ul class="nav navbar-nav">
                                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown {{ request()->routeIs('index') ? 'active' : '' }}">
                                        <a href="/"> Home
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown  {{ request()->routeIs('howit') ? 'active' : '' }}">
                                        <a href="/howit"> How It Works
                                            <span class="arrow"></span>
                                        </a>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown {{ request()->routeIs('attendee.event*') ? 'active' : '' }} ">
                                        <a href="/event"> Event
                                            <span class="arrow"></span>
                                        </a>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown  {{ request()->routeIs('contact') ? 'active' : '' }}">
                                        <a href="/contact"> Contact
                                            <span class="arrow"></span>
                                        </a>
                                        </li>
                                </ul>
                            </div>
                            <!-- END MEGA MENU -->
                        </div>
                    </div>
                    <!-- END HEADER MENU -->
                </div>
                <!-- END HEADER -->
            </div>
        </div>
        @yield('content')
        <div class="page-wrapper-row">
            <div class="page-wrapper-bottom">
                <!-- BEGIN FOOTER -->
                <!-- BEGIN PRE-FOOTER -->
                <div class="page-prefooter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                                <h2>About</h2>
                                <p>let's build and grow your event together </p>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs12 footer-block">
                                <h2>Subscribe Email</h2>
                                <div class="subscribe-form">
                                    <form action="javascript:;">
                                        <div class="input-group">
                                            <input type="text" placeholder="info@acaraid.com" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn" type="submit">Submit</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                                <h2>Follow Us On</h2>
                                <ul class="social-icons">
                                    {{-- <li>
                                        <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
                                    </li> --}}
                                    <li>
                                        <a href="https://instagram.com/acara_id?igshid=ckvwe0sltpnc" data-original-title="instagram" class="instagram"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                                <h2>Contacts</h2>
                                <address class="margin-bottom-40"> Phone: -
                                    <br> Email:
                                    <a href="mailto:info@metronic.com">info@acaraid.com</a>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PRE-FOOTER -->
                <!-- BEGIN INNER FOOTER -->
                <div class="page-footer">
                    <div class="container"> 2016 &copy; Metronic Theme By
                        <a target="_blank" href="http://keenthemes.com/">Keenthemes</a>
                        {{-- <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a> --}}
                    </div>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
                <!-- END INNER FOOTER -->
                <!-- END FOOTER -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    @auth
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                @if(!Auth::user()->hasInvitation())
                <div class="modal-header" style="text-align:center;">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:dimgrey">Organizer Dashboard
                    </h5>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <label>Let's build and grow your organization here to reach all of the targets and
                        goals!</label>
                    <a class="btn btn-rounded btn-large btn-info" href="{{route('organizer.create')}}"><i class="icon-plus-sign"
                            style="color:azure"></i> Create New Organization</a>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                @elseif(Auth::user()->hasInvitation())
                <div class="modal-header" style="text-align:center;">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:dimgrey">Organizer Dashboard
                    </h5>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <h6>You are invited by {{Auth::user()->organizer->name}}</h6>
                    {!! Form::open(['route'=>
                    'member.invite.accept','method'=>'POST','style'=>'display:none','id'=>'acceptForm']) !!}
                    {!! Form::close() !!}
                    <button onclick="event.preventDefault();
                    document.getElementById('acceptForm').submit();" type="submit"
                        class="btn btn-rounded btn-large btn-success"><i class="icon-check" style="color:azure"></i>
                        Accept</button>

                            <button onclick="event.preventDefault();
                            document.getElementById('declineForm').submit();" type="submit"
                        class="btn btn-rounded btn-large btn-danger"><i class="icon-remove-sign"
                            style="color:azure"></i> Decline</button>
                    {!! Form::open(['route'=>
                    'member.invite.decline','method'=>'POST','style'=>'display:none','id'=>'declineForm']) !!}
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endauth

</body>
@include('attendee/partials/script')
</html>
