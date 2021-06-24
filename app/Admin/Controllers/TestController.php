<?php

namespace App\Admin\Controllers;

use App\Models\Question;
use App\Models\QuestionType;
use Dcat\Admin\Form;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Tab;

class TestController extends AdminController
{

    protected function section(Content $content)
    {


//        return  Form::make(new Movie(), function (Form $form) {
        $tab = Tab::make();
        $option = QuestionType::getList();
        $question = Question::getList();
        foreach ($option as $item) {
            $html = '';
            $no = 1;
            foreach ($question as $test) {
                $no_a = 65;
                if ($test['type'] === $item['id']) {
                    $html .= $no++ . ' - ' . $test['title'] . '</br>';
                    foreach ($test['answer'] as $ans) {
                        $html .=chr($no_a++) . ' - ' . $ans['title'] . '</br>';
                    }
                }
                $html .= '<br>';
            }
            $tab->add($item['title'], $html);
        }
//        });

        return $content->body($tab->withCard());

    }
}
