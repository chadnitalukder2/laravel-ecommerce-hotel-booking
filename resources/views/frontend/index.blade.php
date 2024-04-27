 @extends('frontend.main_master');
 @section('main')
 
 <!-- Banner Area -->
   <div class="banner-area" style="height: 480px;">
    <div class="container">
        <div class="banner-content">
            <h1>Discover a Hotel & Resort to Book a Suitable Room</h1>
            
             
        </div>
    </div>
</div>
<!-- Banner Area End -->

<!-- Banner Form Area -->
<div class="banner-form-area">
    <div class="container">
        <div class="banner-form">
            <form>
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK IN TIME</label>
                            <div class="input-group">
                                <input id="datetimepicker" type="text" class="form-control" placeholder="11/02/2020">
                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK OUT TIME</label>
                            <div class="input-group">
                                <input id="datetimepicker-check" type="text" class="form-control" placeholder="11/02/2020">
                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label>GUESTS</label>
                            <select class="form-control">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                            </select>	
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <button type="submit" class="default-btn btn-bg-one border-radius-5">
                            Check Arability
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Banner Form Area End -->

<!-- room_area -->
@include('frontend.Home.room_area');
<!-- Room Area End -->

<!-- book_area_rwo-->
@include('frontend.Home.book_area_rwo');
<!-- Book Area Two End -->

<!-- services_area Three-->
@include('frontend.Home.services_area');
<!-- Services Area Three End -->

<!-- team_area Three -->
<div class="team-area-three pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">TEAM</span>
            <h2>Let's Meet Up With Our Special Team Members</h2>
        </div>
        <div class="team-slider-two owl-carousel owl-theme pt-45">
            <div class="team-item">
                <a href="team.html">
                    <img src="{{ asset('frontend/assets/img/team/team-img1.jpg') }}" alt="Images">
                </a>
                <div class="content">
                    <h3><a href="team.html">Tom Shumate</a></h3>
                    <span>Manager</span>
                    <ul class="social-link">
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                        </li> 
                    </ul>
                </div>
            </div>

            <div class="team-item">
                <a href="team.html">
                    <img src="{{ asset('frontend/assets/img/team/team-img2.jpg') }}" alt="Images">
                </a>
                <div class="content">
                    <h3><a href="team.html">Carrie Horton</a></h3>
                    <span>Chief Reception Officer</span>
                    <ul class="social-link">
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                        </li> 
                    </ul>
                </div>
            </div>

            <div class="team-item">
                <a href="team.html">
                    <img src="{{ asset('frontend/assets/img/team/team-img5.jpg') }}" alt="Images">
                </a>
                <div class="content">
                    <h3><a href="team.html">Brian Orlando</a></h3>
                    <span>Housekeeping</span>
                    <ul class="social-link">
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                        </li> 
                    </ul>
                </div>
            </div>

            <div class="team-item">
                <a href="team.html">
                    <img src="{{ asset('frontend/assets/img/team/team-img4.jpg') }}" alt="Images">
                </a>
                <div class="content">
                    <h3><a href="team.html">Michael Evens</a></h3>
                    <span>Housekeeping</span>
                    <ul class="social-link">
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
                        </li> 
                        <li>
                            <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team Area Three End -->

<!-- testimonials Area Three -->
@include('frontend.Home.testimonials')
<!-- Testimonials Area Three End -->

<!-- FAQ Area -->
@include('frontend.Home.FAQ');
<!-- FAQ Area End -->

<!-- blog Area -->
@include('frontend.Home.blog');
<!-- Blog Area End -->

@endsection