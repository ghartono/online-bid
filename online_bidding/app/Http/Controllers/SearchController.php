<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Auction;
use Carbon\Carbon;
use App\User;
use Image;
use File;
use Illuminate\Support\Facades\Request;

class SearchController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
       $search = \Request::get('search'); //<-- we use global request to get the param of URI

       $auctions = Auction::where('itemname', 'LIKE', '%' . $search . '%')->paginate(10);

       return view('search.index',compact('auctions'));
   }

}
