@extends('layouts.app')

@section('content')
    <div class="row">   
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categories</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category </a>
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
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($categories as $product)
	    <tr>
	        <td>{{ $loop->iteration }}</td>
	        <td>{{ $product->name }}</td>
	        <td>
                <form action="{{ route('categories.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('categories.show',$product->id) }}">Show</a>
                    
                    <a class="btn btn-primary" href="{{ route('categories.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    {{-- {!! $categories->links() !!} --}}

@endsection
{{-- 

@section('content')
<div class="container">
    <h2>Category List</h2>
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
            @foreach($categories as $feedback)
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
    {{ $categories->links() }}
</div>
@endsection

--}}