@extends('layouts.admin')

@section('title','All bids')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Recent bids</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Bid Details
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Bid ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Bidder</th>
                        <th>Bid Amount</th>
                        <th>Email Address</th>
                        <th>Bid start Price</th>
                        <th>Bid Closing</th>
                        <th>Status</th>
                    </tr>
                <tbody>
                    @foreach($bids as $index => $bid)
                    <tr>

                        <td>{{$bid->created_at}}</td>
                        <td>{{$bid->id}}</td>
                        <td>{{$bid->product->id}}</td>
                        <td>{{$bid->product->name}}</td>
                        <td>{{$bid->bidder->name}}</td>
                        <td>{{$bid->price}}</td>
                        <td>{{$bid->bidder->email}}</td>
                        <td>{{$bid->product->start_bid_price}}</td>
                        <td>{{$bid->product->bid_closing_date_time}}</td>
                        <td>{{$bid->status}}</td>


                    </tr>
                    @endforeach
                </tbody>
                </thead>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Bid ID</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Bidder</th>
                        <th>Bid Amount</th>
                        <th>Email Address</th>
                        <th>Bid start Price</th>
                        <th>Bid Closing</th>
                        <th>Deposit Amount</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endsection