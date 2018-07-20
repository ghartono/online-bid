<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	  protected $fillable = [

        'itemname','minbid','currentbid','currentbidder','buyout', 'user_id', 'description', 'itemlocation','itemimage','date','currentbidderid'

    ];


    protected $table = 'auction';

  public function user(){
      return $this->belongsTo('\App\User');
  }
}
