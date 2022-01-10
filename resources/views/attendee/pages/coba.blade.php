@extends('attendee/app')

@section('title')
| Default Profile
@endsection

@section('content')
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="span4">
                <div class="inner-heading">
                    <h2>Organizer Profile</h2>
                </div>
                </div>
            <div class="span8">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a> <i class="icon-angle-right"></i></li>
                    <li><a href="index.html">Event</a> <i class="icon-angle-right"></i></li>
                    <li><a href="index.html">Event Profile</a> <i class="icon-angle-right"></i></li>
                    <li class="active">Organizer Profile</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row team">
            <div class="span3">
              <div class="team-box">
              <a href="/biner" class="thumbnail"><img src="{{asset('img/default.png')}}" alt="" width="100"/></a>
                <div class="roles aligncenter">
                    <p class="lead"><strong>DEFAULT</strong></p><br>
                    <a href="" class="btn btn-success">Follow</a>
                </div>
              </div>
            </div>
            <div class="span9">
                <h6 style="text-align:center">Description</h6>
                <p>“Developing Future and Unyielding Learn of Technology” atau yang di singkat dengan DEFAULT merupakan kelompok studi yang bergerak di bidang pengembangan teknologi seperti pada bidang arsitektur, website, animasi, dan juga aplikasi. Kelompok studi ini di dirikan oleh angkatan pertama program studi ilmu komputer pada tahun 2013.</p><br>
                <p><i class="icon-map-marker"></i>  Kampus A, UNJ, Rawamangun Muka, Jakarta Timur</p>
                <a style="color:steelblue"><i class="font-icon-globe_line"></i>  www.defaultunj.com</a>
            </div>
        </div>

            <div class="row team">
                    <div class="span12">
                      <h6 >Events held by Default</h6>
                    </div>

                    <div class="span3">
                      <div class="team-box">
                        <a href="/biner" class="thumbnail"><img src="../../img/biner.jpeg" alt="" style/></a>
                        <div class="roles aligncenter">
                          <p class="lead"><strong>BINER UNJ</strong></p>
                          <a><i class="icon-home"></i> Kampus A, Rawamangun Muka</a><br>
                          <a><i class="icon-calendar"></i> Sabtu, 13/11/2019</a><br>
                          <a><i class="icon-time"></i> 09.00 s/d 12.00</a><br><br>
                          <a href="/biner"><strong>>>See All<<</strong></a>
                        </div>
                      </div>
                    </div>
                    <div class="span3">
                        <div class="team-box">
                          <a href="/biner" class="thumbnail"><img src="../../img/biner.jpeg" alt="" style/></a>
                          <div class="roles aligncenter">
                            <p class="lead"><strong>BINER UNJ</strong></p>
                            <a><i class="icon-home"></i> Kampus A, Rawamangun Muka</a><br>
                            <a><i class="icon-calendar"></i> Sabtu, 13/11/2019</a><br>
                            <a><i class="icon-time"></i> 09.00 s/d 12.00</a><br><br>
                            <a href=""><strong>>>See All<<</strong></a>
                          </div>
                        </div>
                      </div>
                      <div class="span3">
                        <div class="team-box">
                          <a href="#" class="thumbnail"><img src="../../img/biner.jpeg" alt="" style/></a>
                          <div class="roles aligncenter">
                            <p class="lead"><strong>BINER UNJ</strong></p>
                            <a><i class="icon-home"></i> Kampus A, Rawamangun Muka</a><br>
                            <a><i class="icon-calendar"></i> Sabtu, 13/11/2019</a><br>
                            <a><i class="icon-time"></i> 09.00 s/d 12.00</a><br><br>
                            <a href=""><strong>>>See All<<</strong></a>
                          </div>
                        </div>
                      </div>
                      <div class="span3">
                        <div class="team-box">
                          <a href="#" class="thumbnail"><img src="../../img/biner.jpeg" alt="" style/></a>
                          <div class="roles aligncenter">
                            <p class="lead"><strong>BINER UNJ</strong></p>
                            <a><i class="icon-home"></i> Kampus A, Rawamangun Muka</a><br>
                            <a><i class="icon-calendar"></i> Sabtu, 13/11/2019</a><br>
                            <a><i class="icon-time"></i> 09.00 s/d 12.00</a><br><br>
                            <a href=""><strong>>>See All<<</strong></a>
                          </div>
                        </div>
                      </div>
                  </div>
        </div>
</section>
@endsection
