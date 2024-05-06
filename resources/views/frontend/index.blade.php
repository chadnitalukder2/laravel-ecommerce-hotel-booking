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
            <form method="get" action="{{ route('booking.search') }}">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK IN TIME</label>
                            <div class="input-group">
                                <input required autocomplete="off" type="text" name="check_in" class="form-control dt_picker" placeholder="yyy-mm-dd">
                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK OUT TIME</label>
                            <div class="input-group">
                                <input required autocomplete="off" name="check_out" type="text" class="form-control dt_picker" placeholder="yyy-mm-dd">
                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label>GUESTS</label>
                            <select name="person" class="form-control">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                            </select>	
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <button type="submit" class="default-btn btn-bg-one border-radius-5">
                            Check Availability
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
@include('frontend.Home.team');
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