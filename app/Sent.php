<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Sent extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'sent';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id', 'sent_date','subscriber_id'
    ];


}


