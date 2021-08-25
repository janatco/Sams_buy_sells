@extends('layouts.userDashBoard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View product...') }}</div>

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
                        Product Name is {{$product->name}}
                    </div>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bid Price</th>
                                <th scope="col">Bid date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->bids as $index => $bid)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{$bid->price}}</td>
                                <td>{{$bid->created_at}}</td>
                                <td>{{$bid->status}}</td>
                                <td><a href="">view</a> </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <form method="POST" action="{{ route('awarad') }}">
                        @csrf
                        <input id="productId" name="productId" type="hidden" value="{{$product->id}}">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" value="awardFirstHigest" name="action">
                            Award to highest bidder
                        </button>
                   

                        <button class="btn btn-primary btn-lg btn-block" type="submit" value="awardSecondHigest" name="action">
                            Award to second bidder
                        </button>
                    </form>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection