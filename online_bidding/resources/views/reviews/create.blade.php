    <!-- create.blade.php -->
@section('content')
@extends('layouts.app')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="container">
  <form method="post" action="{{url('reviews')}}" enctype="multipart/form-data">

    <div class="form-group row">
     {{csrf_field()}}
     <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Review</label>
     <div class="col-sm-10">
     	<input name="itemid" type="hidden" value="{{$_GET['id']}}">
        <input name="itemname" type="hidden" value="{{$_GET['itemname']}}">
        <input name="currentbidder" type="hidden" value="{{$_GET['currentbidder']}}">
        <input name="user_id" type="hidden" value="{{$_GET['user_id']}}">
        <input name="review_radio" type="radio" value="good"><label>Good</label>
        <input name="review_radio" type="radio" value="bad"><label>Bad</label><br>
            @if ($errors->has('review_radio'))
                <span class="help-block">
                    <strong>{{ $errors->first('review_radio') }}</strong>
                </span>
            @endif

     </div>
   </div>

    <div class="form-group row">
     {{csrf_field()}}
     <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
     <div class="col-sm-10">
       <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Description" name="description">
     </div>
   </div>
    
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>

@endsection

