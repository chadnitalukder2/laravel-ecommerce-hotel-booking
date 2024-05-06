@extends('frontend.main_master');
 @section('main')
 
    <!-- Inner Banner -->
        <div class="inner-banner inner-bg9">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Rooms</li>
                    </ul>
                    <h3>Rooms</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Room Area -->
        <div class="room-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">ROOMS</span>
                    <h2>Our Rooms & Rates</h2>
                </div>
                <div class="row pt-45">
                @php
                    $empty_array = [];
                @endphp

                @foreach ( $rooms as $item )

                @php
                    $bookings = App\Models\Booking::withCount('assign_rooms')
                    ->whereIn('id', $check_date_booking_ids)->where('room_id', $item->id)->get()->toArray();

                    $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));
                    
                    $av_room = @$item->room_numbers_count-$total_book_room ;
                
                @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                            <a href="room-details.html">
                                <img src="{{ asset( 'upload/room_img/'.$item->image ) }}" width="550px" height="300px" alt="Images">
                            </a>
                            <div class="content">
                                <h6><a href="room-details.html">{{ $item['roomType']['name'] }}</a></h6>
                                <ul>
                                    <li class="text-color">${{ $item->price }}</li>
                                    <li class="text-color">Per Night</li>
                                </ul>
                                <div class="rating text-color">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star-half'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                    <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                            <a href="#" class="prev page-numbers">
                                <i class='bx bx-chevrons-left'></i>
                            </a>

                            <span class="page-numbers current" aria-current="page">1</span>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers">3</a>
                            
                            <a href="#" class="next page-numbers">
                                <i class='bx bx-chevrons-right'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Room Area End -->

 @endsection