@extends('layouts.userDashBoard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product for Bid') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <?php
                     // dd($product);

                    ?>

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
                        {{$product['name']}}
                    </div>
                    <form method="POST" action="{{ route('startBid') }}">
                        @csrf

                        <!-- bid amount -->
                        <div class="form-group row">
                            <label for="bidAmount" class="col-md-4 col-form-label text-md-right">{{ __('Enter your Bid amount') }}</label>

                            <div class="col-md-6">
                                <input id="bidAmount" type="text" class="form-control @error('bidAmount') is-invalid @enderror" name="bidAmount" value="{{ old('bidAmount') }}" required autocomplete="bidAmount" autofocus>

                                @error('nameOnCard')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">

                            <input id="productId" name="productId" type="hidden" value="{{$product['id']}}">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Start to bid..
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection