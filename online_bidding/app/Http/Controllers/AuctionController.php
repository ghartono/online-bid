<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Auction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Image;
use File;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $search = \Request::get('search');

       $auctions = Auction::where('itemname', 'LIKE', '%' . $search . '%')->paginate(10);
		   return view('auction.index',compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Auth::check()) {

      $mytime = Carbon::now('America/Vancouver')->format('m/d/Y H:i:s');

  		$this->validate($request, [
  			'user_id' => 'required',
  			'itemname' => 'required|max:191',
  			'minbid' => 'required',
  			'description' => 'max:191',
        'date' => 'required|date_format:m/d/Y H:i:s|after:' . $mytime,
  		]);

      $auction = new Auction([
  			'user_id' => $request->get('user_id'),
    		'itemname' => $request->get('itemname'),
        'currentbidderid' => $request->get('currentbidderid'),
    		'minbid' => $request->get('minbid'),
  			'currentbid' => $request->get('minbid'),
    		'buyout' => $request->get('minbid'),
  			'description' => $request->get('description'),
        'date' => $request->get('date'),
  			'itemlocation' => $request->get('itemlocation'),
      ]);

      if ($request->hasFile('itemimage')) {
          $image = $request->file('itemimage');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);
          $auction->itemimage = $filename;
      }

    		  $auction->save();
          //$inputs = $request->all();
          //$auction = Auction::Create($inputs);
      }
      return redirect('/auction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id = null)
    {

      $productitems = Auction::all();
      $idcheck = Auth::user()->id;

      foreach($productitems as $post){
          if($post['user_id'] == $idcheck){
            echo $post['itemname'];
          }
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auction = Auction::find($id);

		    return view('auction.edit',compact('auction','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $auction = Auction::find($id);
		//if new bid is lower than current bid && not owner
		if($auction->currentbid >= $request->get('currentbid') && $request->get('currentbidderid') != $auction->user_id)
		{
			return redirect()->back()->with('alert', 'Bid needs to be higher!');
		}
		else if($auction->currentbidder == Auth::user()->name) //if the highest bidder is the bidder
		{
			return redirect()->back()->with('alert', 'You are the highest bidder');
		}
		else //if bid is higher
		{
			$auction->currentbidder = $request->get('currentbidder'); //new bidder
		}

    		$auction->minbid = $request->get('minbid');
  			$auction->currentbid = $request->get('currentbid');
        $auction->currentbidderid = $request->get('currentbidderid');
      	$auction->buyout = $request->get('buyout');
  			$auction->description = $request->get('description');
        $auction->itemlocation = $request->get('itemlocation');
        $auction->date = $request->get('date');

        if ($request->hasFile('itemimage')) {
          File::delete('images/' . $auction->itemimage);

          $image = $request->file('itemimage');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);

          $auction->itemimage = $filename;
        }

    		$auction->save();
    		return redirect('/auction')->with('alert', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auction = Auction::find($id);

        File::delete('images/' . $auction->itemimage);

    		$auction->delete();
    		return redirect('/auction');
    }

}
