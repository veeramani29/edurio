<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Map;;
use DB;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $msg=''; $users = new User;
        if(!empty($_REQUEST)){ #dd($_REQUEST);
        $q_a_map=[];
        $users->email = $_REQUEST['email'];
        $users->desc = $_REQUEST['desc'];
        $users->random_id = rand();
        $users->save();
        if(!empty($_REQUEST)){
        foreach($_REQUEST['answers'] as $key => $value){
            array_push($q_a_map,['main_id'=>$users->id, 'question_id'=> $key,'answer_id'=>$value]);
        }
        DB::table('questions_answers_map')->insert($q_a_map);
         }
        $msg="Successfully posted your answers";
        }

        $result = $users->questions_answers_list();
        return view('welcome', [
            'success' => $msg,
            'questions' => $result['questions'],
            'answers_category' => $result['answers_category']
        ]);


    }
   public function list()
    {
        $users = new User;
        $result = $users->questions_answers_list();
        return response()->json([
        'questions' => $result['questions'],
        'answers_category' => $result['answers_category'],
        ]);
    }

    public function list_set_of_answers()
    {
        $result =  DB::select("Select Q.*,(select concat('[', SUBSTRING_INDEX(group_concat(json_object('quest',QAM.question_id , 'answer',QAM.answer_id ,'main_id', QAM.main_id)),',',40), ']') FROM questions_answers_map QAM WHERE QAM.main_id = Q.id) AS questionnaire from questions as Q");
        return response()->json([
        'total' => count($result),
        'results' => $this->outputmodify($result)
        ]);
    }

    private function outputmodify($outputs){
        return array_map(function($out){
          $out->questionnaire = json_decode($out->questionnaire);
        return $out;
        },$outputs);

    }

    public function return_data()
    {   $users = new User;
        $ques_ans = $users->questions_answers_list();

        $a =  DB::select("SELECT count(*) as question_count_per_answer,answer_id FROM questions_answers_map group by answer_id");
        $q =  DB::select("SELECT count(*) as answer_count_per_question,question_id FROM cms.questions_answers_map group by question_id");
        $avg =  DB::select("SELECT  AVG(question_id) 'question_avg' FROM questions_answers_map");
         $a_result=array_map(function($result) use($ques_ans){
            $fresh=$result;
            $fresh->answer=$ques_ans['answers_category'][$fresh->answer_id-1];
            return $fresh;
        },$a);

         $q_result=array_map(function($result) use($ques_ans){
            $fresh=$result;
            $fresh->question=$ques_ans['questions'][$fresh->question_id-1];
            return $fresh;
        },$q);
        return response()->json([
        'question_avg' => (isset($avg[0])?($avg[0]->question_avg):0),
        'question_count_per_answer' => ($a_result),
        'answer_count_per_question' => ($q_result)
        ]);
    }

    public function open_question()
    {

        $result =  DB::select("SELECT count(*) as open_question_count FROM questions ");
        $word_cloud =  DB::select("SELECT `desc` FROM questions");
        $word_cloud_=array_map(function($word){
            return $word->desc;
        },$word_cloud);
        return response()->json([
        'open_question_count' => (isset($result[0])?($result[0]->open_question_count):0),
        'question' => 'Mother tongue',
        'word_cloud' => $word_cloud_,
        'words_count' => array_count_values($word_cloud_),


        ]);
    }
}
