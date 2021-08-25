@extends('layouts.admin')

@section('title','User feedback')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">User Feedback</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            User Feedback
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Feedback to </th>
                        <th>Log by</th>
                        <th>Email Address</th>
                        <th>Complaint</th>

                    </tr>
                <tbody>
                    @foreach($compliants as $comp)
                    <tr>
                        <td>{{$comp->created_at}}</td>
                        <td>{{$comp->user->name}} </td>
                        <td>{{$comp->logBy->name}}</td>
                        <td>{{$comp->user->email}}</td>
                        <td>{{$comp->complaints}}</td>
                    </tr>
                    @endforeach
                </tbody>
                </thead>
                <tfoot>
                    <th>Date</th>
                    <th>Feedback to </th>
                    <th>Log by</th>
                    <th>Email Address</th>
                    <th>Complaint</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endsection