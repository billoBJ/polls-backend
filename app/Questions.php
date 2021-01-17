<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','multiple_choise','polls_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at'
    ];

    //Relationships Models
    public function polls(){

        return $this->belongsTo('App\Polls');
    }

    public function options(){

        return $this->hasMany('App\Questions_Options');
    }
}
