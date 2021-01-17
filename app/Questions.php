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

    //Relationships Models
    public function polls(){

        return $this->belongsTo('App\Polls');
    }

    public function options(){

        return $this->hasMany('App\Questions_Options');
    }
}
