@extends('layouts.app')

@section('content')
    <div class="row">   
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Feedbacks</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('feedbacks.create') }}"> Create New Feedback </a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th width="100px">Vote Count</th>
            <th>User Name</th>
            @if(Auth::user()->role == 'admin')
            <th width="170px">Comments</th>
            @endif
            <th width="280px">Action</th>
        </tr>
        @foreach ($feedbacks as $feedback)
            {{-- @dd($feedback->user->name) --}}
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $feedback->title }}</td>
                <td>{{ $feedback->vote_count }}</td>
                <td>{{ $feedback->user->name }}</td>
                @if(Auth::user()->role == 'admin')
                <td class="d-flex justify-content-around">
                    <span>
                        {{ $feedback->comments_enabled ? 'Enabled' : 'Disabled' }}
                    </span>
                    {{-- Toggle Comments Button --}}
                    <form method="post" action="{{ route('feedback.toggle-comments', $feedback->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-info pull-right">Toggle it</button>
                    </form>
                </td>
                @endif
                <td>
                    <form action="{{ route('feedbacks.destroy',$feedback->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('feedbacks.show',$feedback->id) }}">Detail</a>
                        @if(Auth::user()->role == 'admin' || Auth::user()->id==$feedback->user_id)
                            <a class="btn btn-primary" href="{{ route('feedbacks.edit',$feedback->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endif
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </table>

    {!! $feedbacks->links() !!}

@endsection
{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feedback List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Vote Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->title }}</td>
                    <td>{{ $feedback->category->name }}</td>
                    <td>{{ $feedback->vote_count }}</td>
                    <td>
                        <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $feedbacks->links() }}
</div>
@endsection

--}}