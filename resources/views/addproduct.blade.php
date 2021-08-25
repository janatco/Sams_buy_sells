@extends('layouts.userDashBoard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add product to auction..') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <?php
                    
                     // dd($errors);

                    ?>

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

                    <div class="alert alert-warning" role="alert">
                        You may add a product to start auction..
                    </div>
                    <form method="POST" action="{{ route('addtoauction') }}" enctype="multipart/form-data">
                        @csrf




                        <!-- Select Prodct Category -->
                        <div class="form-group row">
                            <label for="prodcategory" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>

                            <div class="col-md-6">

                                <select id="prodcategory" name="prodcategory" class="form-control" style="width:250px">
                                    <option value="">--- Select Category ---</option>
                                    @foreach ($formElementValues['categorylist'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Product Name -->
                        <div class="form-group row">
                            <label for="productName" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                            <div class="col-md-6">
                                <input id="productName" type="text" class="form-control @error('productName') is-invalid @enderror" name="productName" value="{{ old('productName') }}" required autocomplete="productName" autofocus>

                                @error('productName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="form-group row">
                            <label for="prodDescription" class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('prodDescription') is-invalid @enderror" id="prodDescription" name="prodDescription" value="{{ old('prodDescription') }}" required autocompelete="prodDescription" autofocus rows="3"></textarea>

                                @error('expireDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Start Bid Price -->
                        <div class="form-group row">
                            <label for="startBidPrice" class="col-md-4 col-form-label text-md-right">{{ __('Starting Bid Price') }}</label>

                            <div class="col-md-6">
                                <input id="startBidPrice" type="text" class="form-control @error('startBidPrice') is-invalid @enderror" name="startBidPrice" value="{{ old('startBidPrice') }}" required autocomplete="startBidPrice" autofocus>

                                @error('startBidPrice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Bid closing date time -->
                        <div class="form-group row">
                            <label for="bidClosing" class="col-md-4 col-form-label text-md-right">{{ __('Bid Closing Date time') }}</label>

                            <div class="col-md-6">
                                <input id="bidClosing" type="text" class="form-control @error('bidClosing') is-invalid @enderror" name="bidClosing" value="{{ old('bidClosing') }}" required autocomplete="bidClosing" autofocus>

                                @error('bidClosing')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Inspection date time -->
                        <div class="form-group row">
                            <label for="inspectionDateTime" class="col-md-4 col-form-label text-md-right">{{ __('Physical Inspection Date Time') }}</label>

                            <div class="col-md-6">
                                <input id="inspectionDateTime" type="text" class="form-control @error('inspectionDateTime') is-invalid @enderror" name="inspectionDateTime" value="{{ old('inspectionDateTime') }}" required autocomplete="inspectionDateTime" autofocus>

                                @error('inspectionDateTime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Prodct Imagee -->
                        <div class="form-group row">
                            <label for="productImage" class="col-md-4 col-form-label text-md-right">{{ __('Upload Product Image') }}</label>

                            <div class="col-md-6">
                                <input id="productImage" type="file" class="form-control @error('productImage') is-invalid @enderror" name="productImage" value="{{ old('productImage') }}" required autocomplete="productImage" autofocus>

                                @error('productImage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Select Prodct Category -->
                        <div class="form-group row">
                            <label for="prodLocation" class="col-md-4 col-form-label text-md-right">{{ __('Product Location') }}</label>

                            <div class="col-md-6">

                                <select id="prodLocation" name="prodLocation" class="form-control" style="width:250px">
                                    <option value="">--- Select Location ---</option>
                                    @foreach ($formElementValues['locationlist'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">


                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Add to auction
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection