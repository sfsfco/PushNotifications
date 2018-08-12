<?php


namespace App;


use Jenssegers\Mongodb\Eloquent\Model;


class Campaign extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title','message','link','icon','image','rtl','explore','explore_link','country','device','brand','model','os','os_version','browser','browser_version','language','connection','frequency','active','created_by','testing','sent','direction'
    ];
}