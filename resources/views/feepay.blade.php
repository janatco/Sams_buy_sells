@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Payment necessary to continue..') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="alert alert-warning" role="alert">
                        Dear {{$userPaymentInfo['name']}}, you have to pay LKR {{$userPaymentInfo['paymentAmount']}} as {{$userPaymentInfo['msgString']}}
                    </div>
                    <form method="POST" action="{{ route('feePayment') }}">
                        @csrf


                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="CreditCard" id="checkoutForm3" checked />
                            <label class="form-check-label" for="checkoutForm3">
                                Credit card
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="DebitCard" id="checkoutForm4" />
                            <label class="form-check-label" for="checkoutForm4">
                                Debit card
                            </label>
                        </div>

                        <!-- Name on Card -->
                        <div class="form-group row">
                            <label for="nameOnCard" class="col-md-4 col-form-label text-md-right">{{ __('Name on Card') }}</label>

                            <div class="col-md-6">
                                <input id="nameOnCard" type="text" class="form-control @error('nameOnCard') is-invalid @enderror" name="nameOnCard" value="{{ old('nameOnCard') }}" required autocomplete="nameOnCard" autofocus>

                                @error('nameOnCard')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Card Number -->
                        <div class="form-group row">
                            <label for="cardNumber" class="col-md-4 col-form-label text-md-right">{{ __('Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="cardNumber" type="text" class="form-control @error('cardNumber') is-invalid @enderror" name="cardNumber" value="{{ old('cardNumber') }}" required autocomplete="cardNumber" autofocus>

                                @error('cardNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Card Expire Date -->
                        <div class="form-group row">
                            <label for="expireDate" class="col-md-4 col-form-label text-md-right">{{ __('Expire Date') }}</label>

                            <div class="col-md-6">
                                <input id="expireDate" type="text" class="form-control @error('expireDate') is-invalid @enderror" name="expireDate" value="{{ old('expireDate') }}" required autocomplete="expireDate" autofocus>

                                @error('expireDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- CVV -->
                        <div class="form-group row">
                            <label for="cvv" class="col-md-4 col-form-label text-md-right">{{ __('CVV') }}</label>

                            <div class="col-md-6">
                                <input id="cvv" type="text" class="form-control @error('cvv') is-invalid @enderror" name="cvv" value="{{ old('cvv') }}" required autocomplete="cvv" autofocus>

                                @error('cvv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-4">

                            <input id="userId" name="uesrId" type="hidden" value="{{$userPaymentInfo['id']}}">
                            <input id="amount" name="amount" type="hidden" value="{{$userPaymentInfo['paymentAmount']}}">

                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                I am agree to pay LKR {{$userPaymentInfo['paymentAmount']}}
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection