<!-- create.blade.php -->
@section('content')
@if(Auth::check())

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
  <form method="post" action="{{url('auction')}}" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
    <input type="hidden" name="userid" value="<?php session_start();?> <?php $_SESSION["userid"] = Auth::user()->id ?>"/>
    <div class="form-group row">
      {{csrf_field()}}
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Item Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="itemname" name="itemname">
      </div>
    </div>

    <div class="form-group row">
	  {{csrf_field()}}
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Min Bid</label>
      <div class="col-sm-10">
        <input type="number" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="minbid" name="minbid">
      </div>
    </div>

    <div class="form-group row">
     {{csrf_field()}}
     <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
     <div class="col-sm-10">
       <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="description" name="description">
     </div>
   </div>

   <div class="form-group row">
     {{csrf_field()}}
     <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Location</label>
     <div class="col-sm-10">
       <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="itemlocation" name="itemlocation">
     </div>
   </div>

   <div class="form-group row">
     {{csrf_field()}}
     <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Image</label>
     <div class="col-sm-10">
       <input type="file" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="itemimage" name="itemimage">
     </div>
   </div>

   <div class="form-group row">
     {{csrf_field()}}
     <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Bid End Date<br><font size="1"> (MM/DD/YYYY HH:MM:SS)<br>24 hour format</font></label>
     <div class="col-sm-10">
       <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="date" name="date">
     </div>
   </div>

    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>
@else
<div class="container">You need to be logged in to add a new auction</div>
@endif
@endsection
