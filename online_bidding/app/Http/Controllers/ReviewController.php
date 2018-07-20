<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Review;
use Carbon\Carbon;
use App\Auction;
use File;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Request;


class ReviewController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    // public function index()
    // {

    // }
    public function index()
    {
       $search = \Request::get('search'); //<-- we use global request to get the param of URI
       $reviews = Review::where('itemname', 'LIKE', '%' . $search . '%')->paginate(10);


        return view('reviews.index',compact('reviews'));
    }



   public function create()
   {


       return view('reviews.create');
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


   public function store(Request $request)
   {
      // if (Auth::check()) {

      //     $this->validate($request, [
      //       'review_radio' => 'required',
      //       'description' => 'max:191',
      //     ]);

      $reviews = Request::all();

          Review::create($reviews);

      // }
        return redirect('/auction');

   }

   public function show($id)
   {

        $review_read = DB::table('reviews')->get();

        return view('reviews', ['review' => $review_read]);
   }

}
