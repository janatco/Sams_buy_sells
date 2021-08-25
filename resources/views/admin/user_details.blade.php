@extends('layouts.admin')
        
        @section('title','User Details')
        @section('content')
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">User Details</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Type</th>
                                            <th>Email Address</th>
                                            <th>Complaints</th>
                                            <th>Status</th>
                                            <th>Registred at</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                            @foreach($users as $index => $user)
                                            <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$user->name}} </td>
                                            <td>{{$user->type}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->complaints->count()}}</td>
                                            <td>{{$user->status}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td><a href="{{url('/admin/unBlock/'.$user->id)}}">UnBlock</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>  
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                            <th>First Name</th>
                                            <th>Type</th>
                                            <th>Email Address</th>
                                            <th>Complaints</th>
                                            <th>Status</th>
                                            <th>Registred at</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                    @endsection         