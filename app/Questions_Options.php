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

    public function questions(){

        return $this->belongsTo('App\Questions');
    }

}
