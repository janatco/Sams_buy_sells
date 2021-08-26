@extends('layouts.admin-lahiru')

@section('heading')
    <h4><span class="badge badge-info">Users</span></h4>
@endsection
@section('content')
    <div class="row">
        <div class="col-4">
           <div class="card">
               <div class="card-body">
                   <form>
                   <div class="form-group">
                       <label>User Type</label>
                       <select class="form-control">
                           <option>Type1</option>
                           <option>Type2</option>
                       </select>
                   </div>
                   <div class="form-group">
                       <label>Name</label>
                       <input type="text" class="form-control" name="" value="">
                   </div>
                   <div class="form-group">
                       <label>Mobile Number</label>
                       <input type="text" class="form-control" name="" value="">
                   </div>
                   <div class="form-group">
                       <label>Service Provider</label>
                       <select class="form-control">
                           <option>Type1</option>
                           <option>Type2</option>
                       </select>
                   </div>
                   <div class="form-group">
                       <label>User Name</label>
                       <input type="text" class="form-control" name="" value="">
                   </div>
                   <div class="form-group">
                       <label>Email</label>
                       <input class="form-control" type="email" name="" value="">
                   </div>
                       <button type="submit" class="btn btn-success">Add</button>
                       <button type="reset" class="btn btn-danger">Reset</button>
                   </form>
               </div>
           </div>
        </div>
        <div class="col">
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Enter username">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                </div>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Mobile Number</th>
                    <th>Type</th>
                    <th></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ljsakjd</td>
                    <td>0222222222</td>
                    <td>@wow</td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ljsakjd</td>
                    <td>0222222222</td>
                    <td>@wow</td>
                    <td><a href="#">Edit</a></td>
                </tr>
                </tr>
            </table>
        </div>
    </div>
@endsection
