@extends('layouts.userDashBoard')

@push('style')
    <style>
        p.msg-in {
            background-color: aliceblue;
            padding: 2rem;
            border-radius: 15px;
            text-align: left;
            max-width: 70%;
        }

        p.msg-out {
            background-color: #f1f1f1;
            padding: 2rem;
            border-radius: 15px;
            text-align: right;
            max-width: 70%;
            margin-left: auto;
        }
        div.msg-container{
            max-height: 45vh !important;
            overflow: auto;
            padding: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="row mx-5">
        <div class="col-4">
            <h4>Conversations</h4>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action"><b>User Name</b><br>Lorem ipsum dolor sit amet.</a>
                <a href="#" class="list-group-item list-group-item-action"><b>User Name</b><br>Lorem ipsum dolor sit amet.</a>
                <a href="#" class="list-group-item list-group-item-action active"><b>User Name</b><br>Lorem ipsum dolor sit amet.</a>
                <a href="#" class="list-group-item list-group-item-action"><b>User Name</b><br>Lorem ipsum dolor sit amet.</a>
                <a href="#" class="list-group-item list-group-item-action"><b>User Name</b><br>Lorem ipsum dolor sit amet.</a>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">User Name</div>
                <div class="card-body">
                    <div class="d-flex flex-column msg-container">
                        @foreach(range(1,15) as $msg)
                            <p class="{{ $msg%2 == 0 ? 'msg-in' : 'msg-out' }}">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint.
                                <br><small class="text-muted">2021-08-26</small>
                            </p>
                        @endforeach
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter message">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
