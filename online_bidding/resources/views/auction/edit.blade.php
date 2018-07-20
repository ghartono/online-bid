<!-- edit.blade.php -->

@section('content')
@if(Auth::check())
@extends('layouts.app')

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

<div class="container">
  <form method="post" action="{{action('AuctionController@update', $id)}}" enctype="multipart/form-data">

	<div class="form-group row">
	@if($auction->itemimage != NULL)
		<img class="img-rounded" style="height:230px; width:230px" src="{{ asset('images/' . $auction->itemimage) }}" />
	@else
		<img class="img-rounded" style="height:230px; width:230px" src="{{ asset('images/noitem.jpg') }}" />
	@endif
	</div>

    <div class="form-group row">
      {{csrf_field()}}
	   <input name="_method" type="hidden" value="PATCH">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Item Name</label>
      <div class="col-sm-10">
		<div> {{$auction->itemname}} </div>
      </div>
    </div>

    <div class="form-group row">
	  {{csrf_field()}}
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Min Bid</label>
      <div class="col-sm-10">
	  @if( $auction->currentbid <= $auction->minbid  && Auth::id() == $auction->user_id )
		<div>$<input type="number" class="form-control-lg" id="lgFormGroupInput" placeholder="minbid" name="minbid" value="{{ number_format($auction->minbid, 2)}}"></div>
	  @else
		<input type="hidden" name="minbid" value="{{ $auction->minbid }}"/>
        <div> ${{ number_format($auction->minbid, 2)}} </div>
	  @endif
      </div>
    </div>

	 <div class="form-group row">
	  {{csrf_field()}}

      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Current Bid</label>
      <div class="col-sm-10">
	  @if( Auth::id() == $auction->user_id || $auction ->date < date('m/d/Y H:i:s'))
		<input type="hidden" name="currentbid" value="{{$auction->currentbid}}"/>
		@if( $auction->currentbid <= $auction->minbid )
		<div> There is no bid yet </div>
		@else
		<div> ${{ number_format($auction->currentbid, 2)}}</div>
		@endif
	  @else
        <div>$<input type="number" class="form-control-lg" id="lgFormGroupInput" placeholder="currentbid" name="currentbid" value="{{$auction->currentbid}}"></div>
	  @endif
      </div>
    </div>

	 <div class="form-group row">
	  {{csrf_field()}}
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Highest Bidder</label>
      <div class="col-sm-10">
	  @if(Auth::id() == $auction->user_id )
	  <input type="hidden" name="currentbidder" value="{{$auction->currentbidder}}">
      <input type="hidden" name="currentbidderid" value="{{$auction->user_id}}">
	  @else
	  <input type="hidden" name="currentbidder" value="{{Auth::user()->name}}">
	  <input type="hidden" name="currentbidderid" value="{{Auth::id()}}">
	  @endif

	  @if( $auction->currentbidder != NULL )
        <div>{{ $auction->currentbidder }}</div>
		@else
		<div> No bidder </div>
	  @endif
      </div>
    </div>

    <div class="form-group row">
	   {{csrf_field()}}
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
      <div class="col-sm-10">
	  @if(Auth::id() == $auction->user_id)
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="description" name="description" value="{{$auction->description}}">
	  @else
		<input type="hidden" name="description" value="{{$auction->description}}"/>
		<div> {{$auction->description}}</div>
	  @endif
      </div>
    </div>

	<div class="form-group row">
     {{csrf_field()}}
       <input type="hidden" name="itemlocation" value="{{$auction->itemlocation}}">
   </div>

   @if( $auction->itemimage == NULL && Auth::id() == $auction->user_id)
    <div class="form-group row">
      {{csrf_field()}}
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Add Image</label>
      <div class="col-sm-10">
        <input type="file" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="itemimage" name="itemimage" value="{{$auction->itemimage}}">
      </div>
    </div>
	@endif

    <div class="form-group row">
       {{csrf_field()}}
	   <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Bid End Date<br><font size="1"> (MM/DD/YYYY HH:MM:SS)<br>24 hour format</font></label>
       <div class="col-sm-10">
         <input type="hidden" name="date" value="{{$auction->date}}">
		 <div> {{$auction->date}} </div>
		 <div data-countdown= "{{$auction->date}}"></div>
       </div>
     </div>


    <div class="form-group row">
      <div class="col-md-2">
	  @if( Auth::id() == $auction->user_id)
      <button type="submit" class="btn btn-primary">Update</button>
	  @elseif($auction ->date > date('m/d/Y H:i:s'))
      <input type="hidden" name="currentbidderid" value="{{Auth::user()->id}}"/>
	    <button type="submit" class="btn btn-primary">Bid</button>
	  @endif
    </div>
	</div>
  </form>
</div>

<div class="container">
<h3>Item Location</h3>
<div id="map"></div>
<br><br>
<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    geocodeAddress(geocoder, map);
  }

  function geocodeAddress(geocoder, resultsMap) {
    var address = "{{$auction->itemlocation}}";
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }

    });
  }
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBhIAzyaKi5SwB7PVzByhu8W5dpYHEDks&callback=initMap">
</script>
</div>
@else
<div class="container">You need to be logged in bid an item</div>
@endif
@endsection
