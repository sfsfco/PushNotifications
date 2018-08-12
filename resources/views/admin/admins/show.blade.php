@extends('admin.layouts.index')
@section('title')
Show {{$title}}
@endsection
@section('css')
@endsection
@section('content')

   <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Show {{$title}}</h3>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admins.index') }}"> Back</a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name:</label>
                  {{ $admin->name }}
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  {{ $admin->email }}
                </div>
                
              </div>
              <!-- /.box-body -->

            
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