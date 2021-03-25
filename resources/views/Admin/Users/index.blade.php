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
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
 <section class="Users">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{route('admin.users.create')}}" name="create" class="create-user" >New User</a>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="user_table">
                        <thead>
                        <tr>
                            <th >ID</th>
                            <th >Name</th>
                            <th>Email</th>
                            <th >Role</th>
                            <th >Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}
                                </td>
                                <td>
                                  <a href="{{route('admin.users.edit',$user->id)}}" name="edit" class="edit btn btn-primary btn-sm" ><i class="icofont-ui-edit"></i></a>
                                <form action="{{route('admin.users.destroy',$user)}}" method="POST">
                                   @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit"  name="delete"  class="delete btn btn-danger btn-sm "><i class="icofont-ui-delete"></i></button>
                                </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 </section>
    </body>
    </html>
@endsection
