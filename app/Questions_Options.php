<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions_Options extends Model
{
    protected $table = 'questions_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','description','question_id'
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

        return $this->belongsTo('App\Questions');
    }

}
