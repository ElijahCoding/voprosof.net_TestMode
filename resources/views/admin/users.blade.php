@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Created at</th>
                          <th scope="col">#</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                          <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td><a href="{{ route('profile', $user) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    {{ $users->links() }}
            </div>
        </div>
      </div>
  </div>
    </div>
@endsection
