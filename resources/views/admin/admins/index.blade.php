@extends('admin.layouts.index')
@section('title')
{{$title}}s
@endsection
@section('css')
<link rel="stylesheet" href="{{url('')}}/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<section class="content">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{$title}}s</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admins.create') }}"> Create New {{$title}}</a>
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
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped" id="users-table">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>created_at</th>
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



<!--

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Message</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($admins as $campaign)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $campaign->name }}</td>
	        <td>{{ $campaign->email }}</td>
	        <td>
                <form action="{{ route('admins.destroy',$campaign->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('admins.show',$campaign->id) }}">Show</a>

 
                    <a class="btn btn-primary" href="{{ route('admins.edit',$campaign->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
-->
 
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{url('')}}/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    

    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url('')}}/{{env('Dashboard')}}/admins/getBasicData',
        "initComplete": function(settings, json) {
            $('.btn.btn-danger').click(function(){
                return (confirm("Delete This Record?")==true)?true:false;
            });
        },
        order: [ [2, 'desc'] ],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: '_id',
            "render": function ( data, type, row, meta ) {
            return "<form action='admins/"+data+"' method='POST' class='text-center'><a class='btn btn-info' href='admins/"+data+"'>Show</a> <a class='btn btn-primary' href='admins/"+data+"/edit'>Edit</a> <input type='hidden' name='_method' value='delete' /> <button type='submit' class='btn btn-danger'>Delete</button><input type='hidden' name='_token' value='{{csrf_token()}}'></form>";
        
            } }
        ]
    });
    
  })
</script>

@endsection
