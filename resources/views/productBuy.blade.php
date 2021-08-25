@extends('layouts.shop')
@section('title','Bidding')
@section('content')
<div class="container bootdey">
<div class="col-md-12">
<section class="panel">
<form method="POST" action="{{ route('startBid') }}">
                        @csrf
      <div class="panel-body">
          <div class="col-md-6">
              <div class="pro-img-details">
                  <img src="{{url('/images/'.$product->image)}}" alt="">
              </div>
              
          </div>
          <div class="col-md-6">
              <h4 class="pro-d-title">
                  <a href="#" class="">
                      {{$product->name}}
                  </a>
              </h4>
              <p>
                  {{$product->description}}
              </p>
              
              <div class="m-bot15"> <strong>Start Bidding price : </strong> <span class="pro-price"> LKR . {{$product->start_bid_price}}</span></div>
              <div class="text-danger">Bdding closes in <span id="time"></span> minutes!</div>
              <br>
              <div class="form-group">
                  <label class="text-warning">Bid Here</label>
                  <button type="button" class="btn btn-warning" style="margin-left:50px;">Complain</button>
                  <input id="bidAmount" style="margin-top:10px;" type="text" class="form-control quantity @error('bidAmount') is-invalid @enderror" name="bidAmount" value="{{ old('bidAmount') }}" required autocomplete="bidAmount" autofocus>
              </div>

              <input id="productId" name="productId" type="hidden" value="{{$product['id']}}">
                            
              <br>
              <p>
                  <button class="btn btn-round btn-danger" type="submit"><i class="fa fa-shopping-cart"></i> Start to bid..</button>
              </p>
          </div>
      </div>
  </section>
  </div>
  </div>

  <script>
      function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds; 

        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();
    setInterval(timer, 1000);
}

window.onload = function () {
    //here we need to pass the closing date time and  need to calculate the time remainig and set that valu to fiveMinutes varialbe
    var fiveMinutes = 60 * 3,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
  </script>
@endsection