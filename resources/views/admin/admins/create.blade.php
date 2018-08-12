@extends('admin.layouts.index')
@section('title')
Add {{$title}}
@endsection
@section('css')
@endsection
@section('content')
 <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New {{$title}}</h3>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admins.index') }}"> Back</a>
                </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

          
          
          <!-- Input addon -->

        </div>
        <!--/.col (left) -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

@endsection
@section('scripts')

@endsection