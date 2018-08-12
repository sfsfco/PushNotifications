<?php


namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Subscriber extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'subscribers';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail'
    ];
}