@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
        </ol>
    </nav>
    <h1 class="h2">Dashboard</h1>
    <div class="row my-4">
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Users</h5>
                <div class="card-body">
                  <h5 class="card-title">345</h5>
                </div>
              </div>
        </div>
        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
                <h5 class="card-header">Reviews</h5>
                <div class="card-body">
                  <h5 class="card-title">2.4k</h5>
                </div>
              </div>
        </div>
        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
                <h5 class="card-header">Comments</h5>
                <div class="card-body">
                  <h5 class="card-title">443</h5>
                </div>
              </div>
        </div>
        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
                <h5 class="card-header">Items</h5>
                <div class="card-body">
                  <h5 class="card-title">64</h5>
                
                </div>
            </div>
        </div>
    </div>
    
@endsection
