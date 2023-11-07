@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Feedback</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('feedbacks.index') }}"> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- @dd($feedback->comments) --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $feedback->title }}
            </div>
            <div class="form-group">
                <strong>Description:</strong>
                {{ $feedback->description }}
            </div>
            <div class="form-group">
                {{-- <strong>Vote Count:</strong>
                {{ $feedback->vote_count }} 
                &nbsp;&nbsp;&nbsp;
                <a href="http://">Click Here</a> For Vote Add/Remove --}}
                {{-- @foreach($feedbacks as $feedback) --}}
                    <!-- Feedback item display... -->
                    <p>Vote Count: {{ $feedback->vote_count }}
                        <form action="{{ route('feedback.vote', $feedback->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Vote</button>
                        </form>
                    </p>
                {{-- @endforeach --}}
            </div>
        </div>
            @if($feedback->comments_enabled)
            <h3 class="mt-5">Comments:</h3>
            @foreach($feedback->comments as $comment)
                {{-- @dd($comment) --}}
                <p><strong>{{ $comment->user->name }}:</strong><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $comment->content }} <br>
                    <span class="publish">
                        Published {{ ($comment->created_at)->diffForHumans() }}
                    </span> 
                </p>
            @endforeach

            <hr>
            <h3>Add a Comment</h3>
            <form method="post" action="{{ route('comments.store', $feedback->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Comment</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
            @endif
    </div>
@endsection

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
