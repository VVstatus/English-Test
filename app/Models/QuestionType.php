<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'question_type';

    public static function getSelect()
    {
        return self::where('status', 1)
            ->pluck('title', 'id')
            ->toArray();
    }

    public static function getList()
    {
        return self::where('status', 1)->get();
    }

}
