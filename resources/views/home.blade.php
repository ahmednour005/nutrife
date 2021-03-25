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
        <link rel="stylesheet" href="{{ URL::asset('assets/css/home.css') }}" />
    </head>
    <body>
            <section class="dashboard text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <a href="{{url('/')}}">
                            <div class="item item1">
                                <div class="row">
                                    <div class="col-5">
                                        <i class="icofont-users-social"></i>
                                    </div>
                                    <div class="col-7">
                                        <h4>Leads</h4>
                                        <p>{{$leads->count()}}</p>
                                    </div>
                                </div>

                            </div>
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="{{url('/shippings')}}">
                                <div class="item item2">
                                    <div class="row">
                                        <div class="col-5">
                                            <i class="icofont-fast-delivery"></i>
                                        </div>
                                        <div class="col-7">
                                            <h4>Shipping</h4>
                                            <p>{{$shippings->count()}}</p>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                        <div class="col-3">
                            @can('manage-users')
                            <a href="{{url('/admin/users')}}">
                                @endcan
                            <div class="item item3">
                                <div class="row">
                                    <div class="col-5">
                                        <i class="icofont-users-alt-5"></i>
                                    </div>
                                    <div class="col-7">
                                        <h4>Users</h4>
                                        <p>{{$users->count()}}</p>
                                    </div>
                            </div>
                        </div>
                        @can('manage-users')
                        </a>
                        @endcan
                    </div>
                </div>
            </section>
    </body>
    </html>
@endsection
