@extends('layouts.userDashBoard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add more images for online inspection ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <?php

                     //dd($product->name);

                    ?>

                    <div class="alert alert-warning" role="alert">
                        Add more images to {{$product->name}}
                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
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

                    <form method="POST" action="{{ route('storeMoreImages') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Prodct Image -->
                        <div class="form-group row">
                            <label for="productImage1" class="col-md-4 col-form-label text-md-right">{{ __('Upload Product Image 1') }}</label>

                            <div class="col-md-6">
                                <input id="productImage1" type="file" class="form-control @error('productImage1') is-invalid @enderror" name="productImage1" value="{{ old('productImage1') }}" required autocomplete="productImage1" autofocus>

                                @error('productImage1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="productImage2" class="col-md-4 col-form-label text-md-right">{{ __('Upload Product Image 2') }}</label>

                            <div class="col-md-6">
                                <input id="productImage2" type="file" class="form-control @error('productImage2') is-invalid @enderror" name="productImage2" value="{{ old('productImage2') }}" required autocomplete="productImage2" autofocus>

                                @error('productImage2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <input id="productId" name="productId" type="hidden" value="{{$product->id}}">


                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Add to images to online inspection
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection