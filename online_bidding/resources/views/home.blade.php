@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                        
                        <a href="/auction"> To The Auction Page </a>
                </div>

                <div class="panel-body">
                        
                        @if(Auth::check())
    <div><a href="/reviews"> See All Reviews </a></td></div>
    @endif
                        <!-- <a href="/reviews"> See All Reviews </a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



    
