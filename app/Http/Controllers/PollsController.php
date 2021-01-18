<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use DB;
use App\Polls;
use App\Questions;
use App\Questions_Options;

class PollsController extends Controller
{

    /**
     * Create a new Poll
     *
     * @param $request
     *
     * @return response
     */
    public function createPoll(Request $request){
        try{
            //VALIDATION
            $request->validate([
                'polls.name' => 'required',
                'polls.description' => 'required',
                'questions.*.description' => 'required',
                'questions.*.multiple_option' => 'integer',
            ]);

            $pollRequest = $request->all();

            //INSERT POLL
            $poll = Polls::create([
                'name' => $pollRequest['polls']['name'],
                'description' => $pollRequest['polls']['description'],
            ]);
            $poll_id = $poll->id;

            //INSER QUESTIONS WITH OPTIONS
            foreach($pollRequest['questions'] as $question){
                $multiple_option = isset($question['multiple_option']) && ($question['multiple_option'] == 0 || $question['multiple_option'] == 1 )  ? $question['multiple_option'] : 0;

                $questionNew = Questions::create([
                    'description' => $question['description'],
                    'multiple_option' => $multiple_option,
                    'polls_id' => $poll_id
                ]);

                $question_id = $questionNew->id;

                foreach($question['options'] as $options ){
                    $option = Questions_Options::create([
                        'description' => $options['description'],
                        'question_id' => $question_id
                    ]);
                }

            }


            return response()->json([
                'message' => 'Poll was created',
                'data' => $pollRequest
            ])->setStatusCode(200);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Internal Error - Poll',
                'error' => $error->getMessage()
            ])->setStatusCode(500);

        }

    }

    /**
     * Get Poll by ID
     *
     * @param $id
     *
     * @return response
     */
    public function getPoll($id){
        try{
            $poll = Polls::find($id);

            if(empty($poll) || $poll->count() === 0 ){
                return response()->json([
                    'message' => 'Data not Found.',
                    'error' => 'No poll found.'
                ])->setStatusCode(404);
            }

            $poll['questions'] = $poll->questions;

            foreach($poll['questions'] as $key => $question){
                $options = Questions_Options::where('question_id','=',$question->id)->get();
                $question['options'] =  $options;
                $poll['questions'] = $question;
            }

            return response()->json($poll)->setStatusCode(200);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Internal Error - getPoll',
                'error' => $error->getMessage()
            ])->setStatusCode(500);

        }

    }

}
