<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DB;
use App\Answer;
use App\Questions;
use Tymon\JWTAuth\Facades\JWTAuth;

class AnswerController extends Controller
{
    protected $user_id;
    protected $admin;


    public function __construct(){
        $this->middleware('api.JwtAuthenticate');

        if(!empty(JWTAuth::user())){
            $this->user_id = JWTAuth::user()->id;
            $this->admin = JWTAuth::user()->admin;
        }


    }

    /**
     * Create a User's Answers
     *
     * @param $request
     * @param $poll_id
     *
     * @return Response
     */
    public function createAnswer(Request $request,$poll_id){
        try{

            $request->validate([
                'answers.*.question_id' => 'required|integer',
                'answers.*.question_option.*.id' => 'required',
            ]);
            $answers = $request['answers'];

            $questionsDB = Questions::where('polls_id','=',$poll_id)->get();
            $questions_count = $questionsDB->count();

            // if($questions_count != sizeof($answer) ){
            //     return response()->json([
            //         'message' => 'Bad Request',
            //         'error' => 'Answer all questions'
            //     ])->setStatusCode(400);
            // }

            foreach($answers as $key => $answer){

                foreach($answer['question_option'] as $option){
                    $userAnswer = Answer::create([
                        'question_id' => $answer['question_id'],
                        'user_id' =>  $this->user_id,
                        'question_option_id' => $option['id']
                    ]);
                }

            }

            return response()->json([
                'message' => 'The answers were saved successfully'
                ])->setStatusCode(200);

        }catch(\Exception $error){
            return response()->json([
                'message' => 'Internal Error - Create Answer',
                'error' => $error->getMessage()
            ])->setStatusCode(500);

        }

    }

    /**
     * Get User's Answers by Poll ID
     *
     * @param $poll_id
     *
     * @return Response
     */
    public function getUserAnswer($poll_id){
        try{
            $answers = Answer::join('questions', 'answers.question_id', '=', 'questions.id')
                            ->join('questions_options', 'answers.question_option_id', '=', 'questions_options.id')
                            ->where('questions.polls_id', '=', $poll_id)
                            ->where('answers.user_id', '=', $this->user_id )
                            ->select('answers.*', 'questions.description as question', 'questions_options.description as option')
                            ->get();


            if($answers->count() === 0){
                return response()->json([
                    'message' => 'Data not Found.',
                    'error' => 'No answers found.'
                ])->setStatusCode(404);
            }


            return response()->json($answers)->setStatusCode(200);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Internal Error - Get Answer',
                'error' => $error->getMessage()
            ])->setStatusCode(500);

        }



    }

    /**
     * Update User's Answers
     *
     * @param $request
     *
     * @return Response
     */
    public function updateUserAnswer(Request $request){
        try{
            $request->validate([
                '*.id' => 'required|integer',
                '*.question_id' => 'required|integer',
                '*.question_option_id' => 'required|integer',
            ]);
            $answers = $request->all();

            foreach($answers as $key => $answer){

                $oldAnswer = Answer::find($answer['id']);
                if($this->user_id !== $oldAnswer['user_id']){
                    return response()->json([
                        'message' => 'Unauthorized User - Update Answer',
                        'error' => 'The user does not have authorization for the request.'
                    ])->setStatusCode(403);
                }

                if( $answer['question_option_id'] !== $oldAnswer['question_option_id'] ){
                    $oldAnswer->question_option_id = $answer['question_option_id'];
                    $oldAnswer->save();
                }

            }


            return response()->json([
                'message' => 'Updated successfull.',
            ])->setStatusCode(200);

        }catch(\Exception $error){

            return response()->json([
                'message' => 'Internal Error - Update Answer',
                'error' => $error->getMessage()
            ])->setStatusCode(500);
        }

    }


}
