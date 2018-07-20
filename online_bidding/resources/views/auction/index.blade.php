<!-- index.blade.php -->
@section('content')
@extends('layouts.app')


@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

<script type = "text/javascript" src = "{{ asset('js/jquery.countdown.js') }}"></script>
<div class="container">
	{!! Form::open(['method'=>'GET','url'=>'auction','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
	<div class="input-group custom-search-form">
		<input type="text" class="form-control" name="search" placeholder="Keyword...">
		<span class="input-group-btn">
			<button class="btn btn-default-sm" type="submit">
				Search
			</button>
		</span>
	</div>
	{!! Form::close() !!}
</div>

<div class="container">
	@if(Auth::check())
    <div><a href="/auction/create" class="btn btn-primary">Add Auction</a></td></div>
	@endif
</div>

<div class="container">
	<div class="row">
	@if($auctions->isEmpty())
    <div class="col-md-10 col-md-offset-1">
		There is no item listed!
	</div>
	@endif
	@foreach($auctions as $post)
	<div class="col-lg-3 text-center">
		<div class ="panel panel-default">

		<div class="panel-heading">
		@if (Auth::check())
			<a href="{{action('AuctionController@edit', $post['id'])}}">
		@endif
				{{$post['itemname']}}
		@if (Auth::check())
			</a>
		@endif
		</div>


		<div style="height:260px" class="panel-body">
		@if (Auth::check())
			<a href="{{action('AuctionController@edit', $post['id'])}}">
		@endif
				@if($post['itemimage'] != NULL)
				<img class="img-rounded" style="height:230px; width:100%" src="{{ asset('images/' . $post['itemimage']) }}" />
				@else
				<img class="img-rounded" style="height:230px; width:100%" src="{{ asset('images/noitem.jpg') }}" />
				@endif
		@if (Auth::check())
			</a>
		@endif
		</div>

		<div class="panel-footer text-left">
			<div>Current bid: ${{ number_format($post['currentbid'],2)}}</div>
			<div data-countdown= "{{$post['date']}}"></div>
			<script>
				$('[data-countdown]').each(function() {
					var $this = $(this), finalDate = $(this).data('countdown');
					$this.countdown(finalDate, function(event) {
						$this.html(event.strftime('%D days %H:%M:%S'));
					});
					$this.on('finish.countdown', function(event){
							$this.html('Bidding is finished!'); //year/month/day hour:minute:seconds
              //make $post['user_id'] equate to $post['currentbidderid']
					});
				});
			</script>

	    @if(Auth::id() == $post['user_id'] && $post['currentbid'] == $post['minbid'])
        <form action="{{action('AuctionController@destroy', $post['id'])}}" method="post">
			{{csrf_field()}}
			<input name="_method" type="hidden" value="DELETE">
			<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete?');">Delete</button>
		</form>
		@else
		@if (Auth::check())
			@if (Auth::user()->name == $post['currentbidder'] && $post['date'] <  date('m/d/Y H:i:s'))
			<form action="{{action('ReviewController@create',$post['id'])}}" method="get">
				<input type="hidden" name="id" value="{{$post['id']}}">
				<input type="hidden" name="itemname" value="{{$post['itemname']}}">
				<input type="hidden" name="currentbidder" value="{{Auth::user()->name}}">
				<input type="hidden" name="user_id" value="{{$post['user_id']}}">
				<button class="btn btn-primary" type="submit">Review</button>
			</form>
			@else
			<form action="{{action('AuctionController@edit', $post['id'])}}">
				<button class="btn btn-primary" type="submit">Show</button>
			</form>
			@endif
		@endif

		@endif
		</div>



	</div>
	</div>
	@endforeach
	</div>
</div>


@endsection
