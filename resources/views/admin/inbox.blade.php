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
                @foreach($threads as $t)
                <a href="{{ route('inbox',$t['id']) }}" class="list-group-item list-group-item-action {{ $t['id'] == $thread ? 'active' : '' }}"><b>{{ $t['name'] ?? "-" }}</b><br>{{ $t['email'] ?? "-" }}</a>
                @endforeach
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">User Name</div>
                <div class="card-body">
                    <div class="d-flex flex-column msg-container">
                        @if($messages)
                            @foreach($messages as $msg)
                                <p class="{{ $msg->is_sender ? 'msg-out' : 'msg-in' }}">
                                    {{ $msg->body }}
                                    <br><small class="text-muted">{{ $msg->created_at }}</small>
                                </p>
                            @endforeach
                        @endif
                    </div>
                    <form method="post" action="{{ route('message.submit') }}">
                        @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" name="thread_id" value="{{ $thread ?? null }}">
                        <input autocomplete="off" name="message" type="text" class="form-control" placeholder="Enter message">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Send</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
