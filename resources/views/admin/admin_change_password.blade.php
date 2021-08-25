@extends('layouts.admin')
        
        @section('title','Modify User')
        @section('content')
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Admin Details</li><span><a href="/modify_admin">+Add New Admin</a></span>
                        </ol>
                        
                    
                            
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile Settings</h4>
                                    </div>
                                    <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">ID</label><input type="text" class="form-control" placeholder="ID" value=""disabled></div></div> 
                                        <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="First name" value=""disabled></div>
                                        <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" value="" placeholder="Last name"disabled></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">Email Address</label><input type="text" class="form-control" placeholder="email address" value=""disabled></div>
                                        <div class="col-md-12"><label class="labels">New Password</label><input type="text" class="form-control" placeholder="password" value=""></div>
                                    </div>
                                
                                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Update Password</button></div>
                                </div>
        </div>
                        </div>
                    </div>
                    @endsection