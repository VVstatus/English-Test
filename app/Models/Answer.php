<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'answer';
    
}
