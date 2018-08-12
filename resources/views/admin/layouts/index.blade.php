<!DOCTYPE html>
<html>
@include('admin.layouts.header')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include('admin.layouts.navbar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    
    <!-- Main content -->
    @include('admin.layouts.message')
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @include('admin.layouts.footer')


  <!-- Control Sidebar -->
@include('admin.layouts.sidebar')

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include('admin.layouts.scripts')


</body>
</html>
