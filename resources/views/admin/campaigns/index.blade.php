@extends('admin.layouts.index')
@section('title')
{{$title}}s
@endsection
@section('css')
<link rel="stylesheet" href="{{url('')}}/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

@endsection
@section('content')
<section class="content">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$title}}s</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('campaigns.create') }}"> Create New {{$title}}</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

      <div class="row">
        <div class="col-xs-12">
         

          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped" id="users-table">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>icon</th>
                            <th>image</th>
                            <th>active</th>
                            <th>created_at</th>
                            <th>message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

 
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{url('')}}/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
  $(function () {
    

    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url('')}}/{{env('Dashboard')}}/campaigns/getBasicData',
        "initComplete": function(settings, json) {
            $('#users-table tbody').on( 'click', 'tr', function () {
                $(this).attr('class','selected');
            });
            $('.btn.btn-danger').click(function(){
                return (confirm("Delete This Record?")==true)?true:false;
            });
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf',
        ],
        order: [ [2, 'desc'] ],
        columns: [
            { data: 'name', name: 'name' },
            { "data": "image",
            "render": function ( data, type, row, meta ) {
            return '<img width="100"  src="{{url("")}}/images/'+data+'"/>';
            } },
            { "data": "icon",
            "render": function ( data, type, row, meta ) {
            return '<img width="100"  src="{{url("")}}/images/'+data+'"/>';
            } },
            { "data": "active",
            "render": function ( data, type, row, meta ) {
                if(data==0){return '<div class="text-center" style="font-size:2em"><i class="fa fa-toggle-off"></i></div>';}else{
                    return '<div class="text-center" style="font-size:2em"><i class="fa fa-toggle-on"></i></div>';
                }
            } },
            { data: 'created_at', name: 'created_at' },
            { data: 'message', name: 'message' },
            { data: '_id',
            "render": function ( data, type, row, meta ) {
            return "<form action='campaigns/"+data+"' method='POST' class='text-center'><a class='btn btn-info' href='campaigns/"+data+"'>Show</a> <a class='btn btn-primary' href='campaigns/"+data+"/edit'>Edit</a> <input type='hidden' name='_method' value='delete' /> <button type='submit' class='btn btn-danger'>Delete</button><input type='hidden' name='_token' value='{{csrf_token()}}'></form>";
        
            } }
        ]
    });

    

  })
</script>

@endsection