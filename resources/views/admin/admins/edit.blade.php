@extends('admin.layouts.index')
@section('title')
Add {{$title}}s
@endsection
@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit {{$title}}</h3>
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
            <form action="{{ route('admins.update',$admin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" name="name" class="form-control" value="{{ $admin->name }}" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" class="form-control" value="{{ $admin->email }}" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">*New Password</label>
                  <input type="password" name="password" class="form-control" >
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



@endsection
@section('scripts')


@endsection