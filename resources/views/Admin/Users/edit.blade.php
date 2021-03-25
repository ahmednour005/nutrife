@extends('layouts.app')

@section('content')
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ URL::asset('assets/css/users.css') }}" />
    </head>
    <body>
    <section class="Users">
        <div class="container">
            <div class="row justify-content-centerus">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit User ( {{$user->name}} )</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.users.update',$user)}}" method="POST">
                                    <div class="form-group row">
                                         <label for="email" class="col-2 col-form-label text-md-right">Email</label>
                                        <div class="col-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                     </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-2 col-form-label text-md-right">Name</label>
                                        <div class="col-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                    </div>
                                      @csrf
                                    {{method_field('PUT')}}
                                <div class="form-group row">
                                    <label for="role" class="col-2 col-form-label text-md-right">Roles</label>
                                    <div class="col-6">
                                        @foreach( $roles as $role)
                                            <div class="form-check">
                                                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                                       @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                <label>{{$role->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="update-user" type="submit"> Update </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    </body>
    </html>
@endsection
