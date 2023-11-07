@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back </a>
            </div>
        </div>
    </div>

<div class="container">
    <h2>{{ $product->name }}</h2>
    <p><strong>Description:</strong> {{ $product->description }}</p>

    <h3>Feedbacks</h3>
    @forelse($product->feedbacks as $feedback)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $feedback->title }}</h5>
                <p class="card-text">{{ $feedback->description }}</p>
                <p class="card-text"><strong>Submitted by:</strong> {{ $feedback->user->name }}</p>
                <p class="card-text"><strong>Submitted at:</strong> {{ $feedback->created_at->diffForHumans() }}</p>
                <p class="card-text"><strong>Votes:</strong> {{ $feedback->vote_count }}</p>
                <!-- Vote Button -->
                <div class="d-flex" style="gap: 10px">
                    <form method="post" action="{{ route('feedback.vote', $feedback->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Vote</button>
                    </form>
                    <a class="btn btn-info" href="{{ route('feedbacks.show',$feedback->id) }}" style="height: 38px;">View Comments</a>
                </div>
            </div>
        </div>
    @empty
        <p>No feedback available for this product.</p>
    @endforelse

    <!-- Feedback Form -->
    <div class="row">
        <div class="col-6">
            <h3>Submit Feedback</h3>
            <form method="post" action="{{ route('feedbacks.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required placeholder="Feedback Title">
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Enter Description here..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>
</div>
@endsection