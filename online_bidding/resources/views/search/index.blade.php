@section('content')

    <div class="panel panel-default">

    {!! Form::open(['method'=>'GET','url'=>'products','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
    <div class="input-group custom-search-form">
	<input type="text" class="form-control" name="search" placeholder="Keyword...">
	<span class="input-group-btn">
		<button class="btn btn-default-sm" type="submit">
		Search
		</button>
	</span>
	</div>
    {!! Form::close() !!}

        <table class="table table-bordered table-hover" >
            <thead>
                <th>Name</th>
            </thead>
            <tbody>
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
              			<a href="{{action('AuctionController@edit', $post['id'])}}">
              				{{$post['itemname']}}
              			</a>
              		</div>

              		<div style="height:260px" class="panel-body">
              			<a href="{{action('AuctionController@edit', $post['id'])}}">
              				<img class="img-rounded" style="height:230px; " src="{{ asset('images/' . $post['itemimage']) }}" />
              			</a>
              		</div>

              		<div class="panel-footer text-left">
              			<div>Current bid: $</div>
              			<div>Location: Canada</div>
              		</div>



              		</div>
              	</div>
                @endforeach
              </div>
              </div>
            </tbody>
        </table>
    </div>
