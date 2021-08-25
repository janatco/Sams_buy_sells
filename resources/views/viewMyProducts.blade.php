@extends('layouts.userDashBoard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View my products...') }}</div>

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
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start Price</th>
                                <th scope="col">Expire date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->start_bid_price}}</td>
                                <td>{{$product->bid_closing_date_time}}</td>
                                <td>{{$product->status}}</td>
                                <td><a href="{{url('viewProduct/'.$product->id)}}">View Bids</a> </td>
                                <td><a href="{{url('addMoreImages/'.$product->id)}}">Add More Images</a> </td>
                            </tr>
                            @endforeach

                           
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection