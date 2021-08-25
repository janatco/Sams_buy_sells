@extends('layouts.admin')
        
        @section('title','Modify User')
        @section('content')
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Add New Admin</li>
                        </ol>
                        
                        <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                <div class="col-md-6"><label class="labels">ID</label><input type="text" class="form-control" placeholder="First ID" value=""></div></div>
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="First name" value=""></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" value="" placeholder="Last name"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                    <div class="col-md-12"><label class="labels">Email Address</label><input type="text" class="form-control" placeholder="email address" value=""></div>
                    <div class="col-md-12"><label class="labels">Password</label><input type="text" class="form-control" placeholder="password" value=""></div>
                </div>
               
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Insert</button></div>
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
                    
                    </div>
                    @endsection