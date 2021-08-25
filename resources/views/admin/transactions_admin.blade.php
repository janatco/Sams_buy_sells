@extends('layouts.admin')

@section('title','Transactions')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Transactions Details</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Transactions Details
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td>{{$tr->id}}</td>
                        <td>{{$tr->created_at}}</td>
                        <td>{{$tr->user->name}}</td>
                        <td>{{$tr->type}}</td>
                        <td>{{$tr->amount}}</td>
                        <td>{{$tr->reson}}</td>
                        <td>{{$tr->status}}</td>

                    </tr>
                    @endforeach
                </tbody>
                </thead>
                <tfoot>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Status</th>


                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endsection