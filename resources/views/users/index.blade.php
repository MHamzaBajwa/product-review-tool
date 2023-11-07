@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>
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
    <th>Email</th>
    <th>Role</th>
    <th width="150px">Is Active</th>
    <th width="280px">Action</th>
  </tr>
  @foreach ($data as $key => $user)
    <tr>
      <td>{{ $loop->count }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        {{ $user->role }}
      </td>
      <td class="d-flex justify-content-around">
          <span>
            {{ $user->is_enabled ? 'Yes' : 'No' }}
          </span>
          @can('toggleStatus', $user)
            @if(Auth::user()->id !=$user->id)
            {{-- Toggle Comments Button --}}
            <form method="post" action="{{ route('users.toggle-status', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-info pull-right">Toggle it</button>
            </form>
            @endif
          @endcan
      </td>
      <td>
          <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
          <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
          {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
      </td>
    </tr>
  @endforeach
</table>

{!! $data->render() !!}

@endsection