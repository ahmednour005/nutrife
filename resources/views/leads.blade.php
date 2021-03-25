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

    <link rel="stylesheet" href="{{ URL::asset('assets/css/leads.css') }}" />
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

<div class="container">
    @can('call-center-leader')
    <div class="btn-upload">

        <a type="button" name="create_record" id="create_record" class="btn btn-primary btn-sm">Create Record</a>
        <a href="{{route('export_excel.leadexcel')}}" id="create_record" class="btn btn-success">Export to Excel</a>
        <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="submit" name="upload" class="upload_btn btn btn-primary" value="Upload">
                <input class="select_file" type="file" name="select_file" value=".xls, .xslx"/>
            </div>
        </form>

    </div>
    @endcan
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
{{--                    <select name="category_filter" id="category_filter" class="form-control">--}}
{{--                        <option value="">Select Category</option>--}}
{{--                        <option value="tagosyl">Tagosyl</option>--}}
{{--                        <option value="croroch">Croroch</option>--}}
{{--                    </select>--}}
                    <table class="table table-bordered table-striped" id="user_table">

                        <thead>
                        <tr>
                            <th width="3%">ID</th>
                            <th width="20%">Name</th>
                            <th width="25%">Address</th>
                            <th width="10%">Phone</th>
                            <th width="13%"> Employee Name </th>
                            <th width="8%">Status</th>
                            <th width="21%">Option</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3" > Name : </label>
                        <div class="col-md-8">
                            <input type="text" name="Name" id="Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Address : </label>
                        <div class="col-md-8">
                            <input type="text" name="Address" id="Address" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Phone : </label>
                        <div class="col-md-8">
                            <input type="text" name="Phone" id="Phone" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Age : </label>
                        <div class="col-md-8">
                            <input type="text" name="Age" id="Age" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Number Of Packages : </label>
                        <div class="col-md-8">
                            <input type="text" name="Number_Of_Packages" id="Number_Of_Packages" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Total Price : </label>
                        <div class="col-md-8">
                            <input type="text" name="Total_Price" id="Total_Price" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Shipping : </label>
                        <div class="col-md-8">
                            <input type="text" name="Shipping" id="Shipping" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Height : </label>
                        <div class="col-md-8">
                            <input type="text" name="Height" id="Height" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Weight : </label>
                        <div class="col-md-8">
                            <input type="text" name="Weight" id="Weight" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date : </label>
                        <div class="col-md-8">
                            <input type="text" name="Date" id="Date" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group"  style="display: none" >
                        <label class="control-label col-md-3">Lead_Category : </label>
                        <div class="col-md-8">
                            <input type="text" name="Lead_Category" id="Lead_Category" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Status : </label>
                        <div class="col-md-8">
                            <select class="custom-select mr-sm-2" name="Status" id="Status">
                                <option selected hidden>Choose...</option>
                                <option  value="Pending">Pending</option>
                                <option value="Confirm">Confirm</option>
                                <option value="Cancel">Cancel</option>
                            </select>

                        </div>
                    </div>
                    @can('call-center-leader')
                    <div class="form-group">
                        <label class="control-label col-md-3">Employee Name : </label>
                        <div class="col-md-8">
                            <select class="custom-select mr-sm-5" name="Employee_Name" id="Employee_Name">
                                <option selected hidden>Choose...</option>
                                @foreach($users as $u)
                                    <option  value="{{$u->name}}">{{$u->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @endcan
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn-update" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="ViewLeads" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lead Data</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <div class="controller">
                    <div class="row">
                        <div class="col-6">
                           <span class="data_type">Name :</span> <span class="name"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Phone :</span> <span class="phone"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Address :</span> <span class="address"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Age :</span> <span class="Age"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Number Of Packages :</span> <span class="Number_Of_Packages"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Total Price :</span> <span class="Total_Price"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Shipping :</span> <span class="Shipping"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Height :</span> <span class="Height"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Weight :</span> <span class="Weight"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Date :</span> <span class="Date"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Status :</span> <span class="Status"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Category :</span> <span class="Lead_Category"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Traceability :</span> <span class="Traceability"> </span>
                        </div>
                        <div class="col-6">
                            <span class="data_type">Employee Name :</span> <span class="Employee_Name"> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn-update">OK</button>
            </div>
        </div>
    </div>
</div>



<script>

    $(document).ready(function(){



      var table =   $('#user_table').DataTable({
            processing: true,
            serverSide: true,
           "bPaginate": false,
            ajax:{
                url: "{{ route('leads.index')}}",
                data: function (d) {
                    d.Lead_Category = $('#category_filter').val()
                }
            },
            columns:[
                {
                    data: 'id',
                    name: 'ID',
                    orderable: false
                },
                {
                    data: 'Name',
                    name: 'Name',
                    orderable: false
                },
                {
                    data: 'Address',
                    name: 'Address',
                    orderable: false
                },
                {
                    data: 'Phone',
                    name: 'Phone',
                    orderable: false
                },
                {
                    data: 'Employee_Name',
                    name: 'Employee_Name',
                    orderable: false
                },
                {
                    data: 'Status',
                    name: 'Status',
                    orderable: false
                },
                {data: 'Option',
                    name: 'Option',
                    orderable: false,
                }
            ],
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ){
              switch (aData['Status']){
                  case 'Pending':
                      $('td', nRow).css('background-color', 'rgb(249 255 0 / 28%)')
                      break;
                  case 'Confirm':
                      $('td', nRow).css('background-color', 'rgb(0 255 90 / 34%)')
                      break;
                  case 'Cancel':
                      $('td', nRow).css('background-color', 'rgb(255 0 47 / 38%)')
                      break;
                }

              if(aData['Employee_Name'] == '{{Auth::user()->name}}'){
                  $('td', nRow).show();
              }
              else if('{{Auth::user()->name}}' != 'Admin' && '{{Auth::user()->name}}' != 'Call Center Leader'){
                  $('td',nRow).hide();
              }
             }
            });
            // $('#category_filter').change(function(){
            //    table.draw();
            // });
            $("#user_table_filter input").keyup(function(){
                table.draw();
            });

            //view data
            var showById;
            $(document).on('click', '.view', function() {
                $('#ViewLeads').modal('show');
                showById = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url:"leads/show/"+showById,
                    dataType:"json",
                    success:function(html){
                        $('#ViewLeads .name').html(html.data.Name);
                        $('#ViewLeads .address').html(html.data.Address);
                        $('#ViewLeads .phone').html(html.data.Phone);
                        $('#ViewLeads .Status').html(html.data.Status);
                        $('#ViewLeads .Lead_Category').html(html.data.Lead_Category);
                        $('#ViewLeads .Date').html(html.data.Date);
                        $('#ViewLeads .Traceability').html(html.data.Traceability);
                        $('#ViewLeads .Number_Of_Packages').html(html.data.Number_Of_Packages);
                        $('#ViewLeads .Total_Price').html(html.data.Total_Price);
                        $('#ViewLeads .Shipping').html(html.data.Shipping);
                        $('#ViewLeads .Height').html(html.data.Height);
                        $('#ViewLeads .Employee_Name').html(html.data.Employee_Name);
                        $('#ViewLeads .Weight').html(html.data.Weight);
                        $('#ViewLeads .Age').html(html.data.Age);
                    }
                })


            });
            $('#ViewLeads #ok_button').click(function() {
                $('#ViewLeads').modal('hide');
            });


            $('#sample_form_update').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('leads.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                            $('#formModal').modal('hide');
                        }
                        $('#form_result').html(html);
                    }
                });

            });

        //add and edit
        $('#create_record').click(function(){
            $('.formModal .modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#sample_form')[0].reset();
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            if($('#action').val() == 'Add')
            {
                $.ajax({
                    url:"{{ route('leads.store') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                            $('#formModal').modal('hide');
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action').val() == "Edit")
            {
                $.ajax({
                    url:"{{ route('leads.update') }}",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';

                        }
                        if(data.success)
                        {
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                            $('#formModal').modal('hide');
                        }
                        $('#form_result').html(html);
                    }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"/leads/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#Name').val(html.data.Name);
                    $('#Address').val(html.data.Address);
                    $('#Phone').val(html.data.Phone);
                    $('#Status').val(html.data.Status);
                    $('#Number_Of_Packages').val(html.data.Number_Of_Packages);
                    $('#Total_Price').val(html.data.Total_Price);
                    $('#Shipping').val(html.data.Shipping);
                    $('#Employee_Name').val(html.data.Employee_Name);
                    $('#Height').val(html.data.Height);
                    $('#Height').val(html.data.Height);
                    $('#Lead_Category').val(html.data.Lead_Category);
                    $('#Age').val(html.data.Age);
                    $('#hidden_id').val(html.data.id);
                    $('#formModal .modal-title').text("Edit New Record");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });



        //delete
        var user_id;
        $(document).on('click', '.delete', function(){
            user_id = $(this).attr('id');
            $.ajax({
                url:"leads/destroy/"+user_id,
                beforeSend:function(){
                    $('.change'+user_id).text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#user_table').DataTable().ajax.reload();
                    }, 1000);
                }
            })
        });

    });
</script>


</body>
</html>
@endsection
