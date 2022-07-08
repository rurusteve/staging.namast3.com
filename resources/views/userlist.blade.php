@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="container">
                                <h2>Employees</h2>
                                <p>You are seeing the list of employee:</p>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th colspan="2">Options</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>@if ($user->admin === 1)
                                                Admin
                                            @elseif ($user->admin === 2)
                                                Assistant
                                                @else
                                                User
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ url('/userlist/'.$user->id.'/edit') }}">Edit</a>
                                            <button class='btn btn-xs btn-danger' type='submit' data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message='Are you sure you want to delete this user ?'>
                                                <i class='glyphicon glyphicon-trash'></i> Delete
                                            </button>
                                            @include('deleteconfirm')
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links() }}
                            <td>
                                <a href="/register"><button type="button" class="btn btn-primary">Add Employee</button></a>
                                <a href="{{ url('/') }}"><button type="button" class="btn btn-outline-secondary">Back to home</button></a>
                            </td>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
