<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itemid','itemname','user_id', 'currentbidder','review_radio', 'description',
    ];

    public function auctions(){
        return $this->hasMany('\App\Auction');
    }
}
