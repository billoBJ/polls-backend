<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
    protected $table = 'polls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'description','enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function questions(){

        return $this->hasMany('App\Questions');
    }


}
