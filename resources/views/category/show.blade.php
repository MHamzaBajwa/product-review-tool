@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $product->description }}
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

{{-- @section('content')
<div class="container">
    <h2>{{ $feedback->title }}</h2>
    <p><strong>Description:</strong> {{ $feedback->description }}</p>
    <p><strong>Category:</strong> {{ $feedback->category->name }}</p>
    <p><strong>Vote Count:</strong> {{ $feedback->vote_count }}</p>
    <hr>
    <h3>Comments</h3>
    @foreach($feedback->comments as $comment)
        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
    @endforeach
</div>
@endsection --}}
