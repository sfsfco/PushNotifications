@extends('admin.layouts.index')
@section('title')
Add {{$title}}
@endsection
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show {{$title}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('campaigns.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $campaign->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Message:</strong>
            {{ $campaign->message }}
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection