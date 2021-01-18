<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','question_id', 'question_option_id','user_id'
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
    public function question(){

        return $this->belongsTo('App\Questions');
    }

    public function option(){

        return $this->belongsTo('App\Questions_Options');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }


}
