<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'question';

    public function q_type()
    {
        return $this->hasMany(QuestionType::class);
    }


    public function getQuestionsAttribute($questions)
    {
        return array_values(json_decode($questions, true) ?: []);
    }

    public function setQuestionsAttribute($questions)
    {
        $this->attributes['questions'] = json_encode(array_values($questions),true);
    }

    public function getAnswersAttribute($answers)
    {
        return array_values(json_decode($answers, true) ?: []);
    }

    public function setAnswersAttribute($answers)
    {
        $this->attributes['answers'] = json_encode(array_values($answers),true);
    }


    public static function getList()
    {
        return self::where('status', 1)->get()->toArray();
    }
}
