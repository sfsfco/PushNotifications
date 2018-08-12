@extends('admin.layouts.index')
@section('title')
Edit {{$title}}s
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
              <h3 class="box-title">Add New {{$title}}</h3>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('campaigns.index') }}"> Back</a>
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
            <form action="{{ route('campaigns.update',$campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Campaign Name:</label>
                    <input type="text" name="name" value="{{ $campaign->name }}" class="form-control" placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" value="{{ $campaign->title }}" class="form-control" placeholder="Title" required>
                  </div>
                  <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" name="link" value="{{ $campaign->link }}" class="form-control" placeholder="Link" required>
                  </div>
                  <div class="form-group">
                    <label for="direction">Direction:</label>
                    <select name="direction" id='direction' class="form-control" placeholder="Direction">
                          <option value="ltr" @if($campaign->direction == 'ltr') selected="selected" @endif>ltr</option>
                          <option value="rtl" @if($campaign->direction == 'rtl') selected="selected" @endif>rtl</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="frequency">Frequency:</label>
                    <select name="frequency" id='frequency' class="form-control" placeholder="Frequency">
                          <option value="24" @if($campaign->frequency == '24') selected="selected" @endif>1 view / day</option>
                          <option value="12" @if($campaign->frequency == '12') selected="selected" @endif>2 view / day</option>
                          <option value="8" @if($campaign->frequency == '8') selected="selected" @endif>3 view / day</option>
                          <option value="6" @if($campaign->frequency == '6') selected="selected" @endif>4 view / day</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="explore">Explore:</label>
                    <input type="text" name="explore" class="form-control" value="{{ $campaign->explore }}" placeholder="Explore" required>
                  </div>
                  <div class="form-group">
                    <label for="explore_link">Explore Link:</label>
                    <input type="text" name="explore_link" class="form-control" value="{{ $campaign->explore_link }}" placeholder="Explore Link" required>
                  </div>
                  <div class="form-group">
                    <label for="country">Country:</label>
                    <select name="country[]" multiple="multiple" id='country' class="form-control" placeholder="Country">
                           @foreach ($country as $val)
                                <option value="{{ $val->country }}"  <?php echo(in_array($val->country, explode(',', $campaign->country)) && $val->country!='')?"selected='selected'":""; ?> >{{ $val->country }}</option>
                            @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="model">Model:</label>
                    <select name="model[]" multiple="multiple" id='model' class="form-control" placeholder="Model">
                          @foreach ($model as $val)
                              <option value="{{ $val->model }}"  <?php echo(in_array($val->model, explode(',', $campaign->model)) && $val->model!='')?"selected='selected'":""; ?>>{{ $val->model }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="os">Os:</label>
                    <select name="os[]" multiple="multiple" id='os' class="form-control" placeholder="Os">
                          @foreach ($os as $val)
                              <option value="{{ $val->os }}"  <?php echo(in_array($val->os, explode(',', $campaign->os)) && $val->os!='')?"selected='selected'":""; ?>>{{ $val->os }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="osversion">Os Version:</label>
                    <select name="osversion[]" multiple="multiple" id='osversion' class="form-control" placeholder="Os Version">
                          @foreach ($osversion as $val)
                              <option value="{{ $val->osversion }}"  <?php echo(in_array($val->osversion, explode(',', $campaign->osversion)) && $val->osversion!='')?"selected='selected'":""; ?>>{{ $val->osversion }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="browser">Browser:</label>
                    <select name="browser[]" multiple="multiple" id='browser' class="form-control" placeholder="Browser">
                          @foreach ($browser as $val)
                              <option value="{{ $val->browser }}"  <?php echo(in_array($val->browser, explode(',', $campaign->browser)) && $val->browser!='')?"selected='selected'":""; ?>>{{ $val->browser }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="browserversion">Browser Version:</label>
                    <select name="browserversion[]" multiple="multiple" id='browserversion' class="form-control" placeholder="Browser Version">
                          @foreach ($browserversion as $val)
                              <option value="{{ $val->browserversion }}"  <?php echo(in_array($val->browserversion, explode(',', $campaign->browserversion)) && $val->browserversion!='')?"selected='selected'":""; ?>>{{ $val->browserversion }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="language">Language:</label>
                    <select name="language[]" multiple="multiple" id='language' class="form-control" placeholder="Language">
                          @foreach ($language as $val)
                              <option value="{{ $val->language }}"  <?php echo(in_array($val->language, explode(',', $campaign->language)) && $val->language!='')?"selected='selected'":""; ?>>{{ $val->language }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="connection">Connection:</label>
                    <select name="connection[]" multiple="multiple" id='connection' class="form-control" placeholder="Connection">
                          @foreach ($connection as $val)
                              <option value="{{ $val->connection }}"  <?php echo(in_array($val->connection, explode(',', $campaign->connection)) && $val->connection!='')?"selected='selected'":""; ?>>{{ $val->connection }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="device">Device:</label>
                    <select name="device[]" multiple="multiple" id='device' class="form-control" placeholder="Device">
                          @foreach ($device as $val)
                              <option value="{{ $val->device }}"  <?php echo(in_array($val->device, explode(',', $campaign->device)) && $val->device!='')?"selected='selected'":""; ?>>{{ $val->device }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="brand">Brand:</label>
                    <select name="brand[]" multiple="multiple" id='brand' class="form-control" placeholder="Brand">
                          @foreach ($brand as $val)
                              <option value="{{ $val->brand }}"  <?php echo(in_array($val->brand, explode(',', $campaign->brand)) && $val->brand!='')?"selected='selected'":""; ?>>{{ $val->brand }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image">Image:</label>
                    <img width="100"   src="{{url('')}}/images/{{$campaign->image}}" />
                    <input type="file" name="image" id='image' class="form-control" placeholder="Image">
                    <input type="hidden" name="old_image" value="{{ $campaign->image }}" />
                    <p class="help-block">Best Size [350*200].</p>
                  </div>
                  <div class="form-group">
                    <label for="icon">Icon:</label>
                    <img width="100"   src="{{url('')}}/images/{{$campaign->icon}}" />
                    <input type="file" name="icon" id='icon' class="form-control" placeholder="Icon">
                    <input type="hidden" name="old_icon" value="{{ $campaign->icon }}" />
                    <p class="help-block">Best Size [192*192].</p>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" rows="3" name="message" id="message" placeholder="Message ...">{{ $campaign->message }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="active">Active:</label>
                    <select name="active" id='active' class="form-control" placeholder="Active">
                        <option value="0" @if($campaign->active == '0') selected="selected" @endif>no</option>
                        <option value="1" @if($campaign->active == '1') selected="selected" @endif>yes</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="active">Total Audiance:</label>
                    <div class="btn btn-block btn-primary btn-lg" id="audiance_num">{{$count}}</div>
                  </div>
                  
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <meta name="csrf-token" content="{{ csrf_token() }}">
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

<script>
  $(function () {
    data = $("form").serialize()+'&send=0';
            console.log(data);

            $.ajax({
               headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                type: "POST",
                url: "{{url('')}}/{{env('Dashboard')}}/campaigns/getcount",
                datatype : 'html',
                data: { data },
                })
                .done(function( msg ) {
                    $('#audiance_num').html(msg);
                    console.log( "Data Saved: " + msg );
                });
            return false;
   
  })

  $('select').click(function(){
            data = $("form").serialize()+'&send=0';
            console.log(data);

            $.ajax({
               headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                type: "POST",
                url: "{{url('')}}/{{env('Dashboard')}}/campaigns/getcount",
                datatype : 'html',
                data: { data },
                })
                .done(function( msg ) {
                    $('#audiance_num').html(msg);
                    console.log( "Data Saved: " + msg );
                });
            return false;
        });
</script>
@endsection