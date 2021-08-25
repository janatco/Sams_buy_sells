@extends('layouts.admin')
        
        @section('title','Admin')
        @section('content')
        <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Auction Details</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Auction Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            
                                            <th>Auction ID</th>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Minium Bid</th>
                                            <th>Starting Date Time</th>
                                            <th>Ending Date Time</th>
                                            <th>Status</th> 
                                        </tr>
                                        <tbody>
                                            <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>Chair</td>
                                            <td>2000 LKR</td>
                                            <td>22/aug/2021 01:00pm</td>
                                            <td>22/aug/2021 04:00pm</td>
                                            <td>Open</td>
                                            
                                            </tr>
                                        </tbody>
                                    </thead>  
                                    <tfoot>
                                        <tr>
                                            <th>Auction ID</th>
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Minium Bid</th>
                                            <th>Starting Date Time</th>
                                            <th>Ending Date Time</th>
                                            <th>Status</th> 
                                        </tr>
                                    </tfoot>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
        @endsection