@extends('layouts.admin')

@section('title','Product Details')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Product Details</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Product Details
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Product Category</th>
                        <th>Product Image</th>
                        <th>User </th>
                        <th>User Email Address</th>
                        <th>Status</th>
                        <th>Start price</th>

                    </tr>
                    @foreach($products as $index=>$product)
                <tbody>
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->category}}</td>
                        <td><img src="{{url('/images/'.$product->image)}}" alt="Image" width="50" /></td>
                        <td>{{$product->seller->name}}</td>
                        <td>{{$product->seller->email}}</td>
                        <td>{{$product->status}}</td>
                        <td>{{$product->start_bid_price}}</td>

                    </tr>
                </tbody>
                @endforeach
                </thead>
                <tfoot>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Product Category</th>
                        <th>Product Image</th>
                        <th>User </th>
                        <th>User Email Address</th>
                        <th>Status</th>
                        <th>Start price</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endsection