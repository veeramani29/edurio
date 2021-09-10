<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     protected $table = 'questions';
     public function questions_answers_list()
     {
        $Questions=['Route 53','S3','Lambda','Cognito','Elastic file storage','Dynamo DB','SQS','Glue','Athena','Redshift','MySQL','RDS'];
        $Answers=['No experience','Novice','Intermediate','Advanced','Expert','Mentor'];
        return [
            'questions' => $Questions,
            'answers_category' => $Answers,
        ];
     }
}