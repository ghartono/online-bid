<!-- index.blade.php -->
@section('content')
@extends('layouts.app')

<div class="container">
  {!! Form::open(['method'=>'GET','url'=>'auction','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
  <div class="input-group custom-search-form">
    <input type="text" class="form-control" name="search" placeholder="Search Item...">
    <span class="input-group-btn">
      <button class="btn btn-default-sm" type="submit">
        Search
      </button>
    </span>
  </div>
  {!! Form::close() !!}
</div>


<div class="table-responsive">
  <table class="table table-striped table-hover table-condensed">
    <thead>
      <tr>
        <th><strong>Item Name</strong></th>
        <th><strong>Owner/Seller ID</strong></th>
        <th><strong>Highest Bidder</strong></th>
        <th><strong>Review</strong></th>
        <th><strong>Description</strong></th>
      </tr>
    </thead>
    <tbody>

    @foreach($reviews as $data)
          <tr>
            <th>{{$data->itemname}}</th>
            <th>{{$data->user_id}}</th>
            <th>{{$data->currentbidder}}</th>
            <th>{{$data->review_radio}}</th>
            <th>{{$data->description}}</th>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
