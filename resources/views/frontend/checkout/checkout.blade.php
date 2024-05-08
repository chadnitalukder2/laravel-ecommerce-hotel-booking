@extends('frontend.main_master');
 @section('main')
 
<!-- Inner Banner -->
 <div class="inner-banner inner-bg7">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li> Check Out</li>
            </ul>
            <h3> Check Out</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Checkout Area -->
<section class="checkout-area pt-100 pb-70">
    <div class="container">
       <form role="form" method="post" action="{{ route('checkout_store') }}" class="stripe_form require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Country <span class="required">*</span></label>
                                    <div class="select-box">
                                        <select name="country" class="form-control">
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="India">India</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="China">China</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Germany">Germany</option>
                                            <option value="France">France</option>
                                            <option value="Japan">Japan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label> Name <span class="required">*</span></label>
                                    <input type="text" name="name" value="{{ \Auth::user()->name }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="email" value="{{ \Auth::user()->email }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label> Phone</label>
                                    <input type="text" name="phone" value="{{ \Auth::user()->phone }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name="address" value="{{ \Auth::user()->address }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>State <span class="required">*</span></label>
                                    <input type="text" name="state"  class="form-control">
                                     @if ($errors->has('state'))
                                        <div class="text-danger">{{ $errors->first('state') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>ZipCode / County <span class="required">*</span></label>
                                    <input type="text" name="zip_code" class="form-control">
                                     @if ($errors->has('state'))
                                        <div class="text-danger">{{ $errors->first('zip_code') }}</div>
                                    @endif
                                </div>
                            </div>       

                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <section class="checkout-area pb-70">
                        <div class="card-body">
                              <div class="billing-details">
                                    <h3 class="title">Booking Summary</h3>
                                    <hr>

                                    <div style="display: flex">
                                          <img style="height:100px; width:120px;object-fit: cover" src=" {{ (!empty($room->image)) ? url('upload/room_img/'.$room->image) : url('upload/no_image.jpg') }} " alt="Images" alt="Images">
                                          <div style="padding-left: 10px;">
                                                <a href=" " style="font-size: 20px; color: #595959;font-weight: bold">{{ @$room['roomType']['name'] }}</a>
                                                <p><b>${{ $room->price }} / Night</b></p>
                                          </div>

                                    </div>

                                    <br>

                                    <table class="table" style="width: 100%">
                                    
                                     

                                       @php
                                           $subtotal = $room->price * $nights * (int)$book_data['number_of_rooms']; 
                                           $discount =($room->discount/100)*$subtotal;  
                                       @endphp
                                        <h1>subtotal : {{ $book_data['number_of_rooms'] }} </h1>  
                                        
                                        <tr>
                                            <td><p>Total Night <br> <b> ( {{ $book_data['check_in'] }} - {{ $book_data['check_out'] }})</b></p></td>
                                            <td style="text-align: right"><p> {{ $nights }} Days</p></td>
                                        </tr>
                                        <tr>
                                            <td><p>Total Room</p></td>
                                             <td style="text-align: right"><p>{{ @$room['roomType']['name'] }}</p></td>
                                        </tr>

                                          <tr>
                                                <td><p>Total Room</p></td>
                                                <td style="text-align: right"><p>{{ $book_data['number_of_rooms'] }}</p></td>
                                          </tr>
                                          <tr>
                                                <td><p>Subtotal</p></td>
                                                {{-- <td style="text-align: right"><p>${{ $subtotal }}</p></td> --}}
                                            </tr>
                                                <td><p>Discount</p></td>
                                                {{-- <td style="text-align:right"> <p>${{ $discount }}</p></td> --}}
                                            </tr>
                                            <tr>
                                                <td><p>Total</p></td>
                                                {{-- <td style="text-align:right"> <p>${{ $subtotal-$discount }}</p></td> --}}
                                            </tr>
                                    </table>

                              </div>
                        </div>
                  </section>

                </div>


                <div class="col-lg-8 col-md-8">
                    <div class="payment-box">
                        <div class="payment-method">
                           
                             <p>
                                <input type="radio" id="cash-on-delivery" name="payment_method" value="COD">
                                <label for="cash-on-delivery">Cash On Delivery</label>
                            </p>
                             <p>
       <input type="radio" class="pay_method" id="stripe" name="payment_method" value="Stripe">
        <label for="stripe">Stripe</label>
          </p>


           <div id="stripe_pay" class="d-none">
        <br>
        <div class="form-row row">
              <div class="col-xs-12 form-group required">
                    <label class="control-label">Name on Card</label>
                    <input class="form-control" size="4" type="text" />
              </div>
        </div>
        <div class="form-row row">
              <div class="col-xs-12 form-group  required">
                    <label class="control-label">Card Number</label>
                    <input autocomplete="off" class="form-control card-number" size="20" type="text" />
              </div>
        </div>
        <div class="form-row row">
              <div class="col-xs-12 col-md-4 form-group cvc required"><label class="control-label">CVC</label><input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="text" /></div>
              <div class="col-xs-12 col-md-4 form-group expiration required"><label class="control-label">Expiration Month</label><input class="form-control card-expiry-month" placeholder="MM" size="2" type="text" /></div>
              <div class="col-xs-12 col-md-4 form-group expiration required"><label class="control-label">Expiration Year</label><input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="text" /></div>
        </div>
        <div class="form-row row">
              <div class="col-md-12 error form-group hide"><div class="alert-danger alert">Please correct the errors and try again.</div></div>
        </div>
  </div>

                             {{-- <p>Session Value : {{ json_encode(session('book_date')) }}</p> --}}
                           
                        </div>

                       <button type="submit" class="order-btn">Place to Order</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Area End --> 







 @endsection