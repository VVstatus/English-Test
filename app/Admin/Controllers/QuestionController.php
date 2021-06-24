<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Form\QuestionAction;
use App\Admin\Repositories\Question;
use App\Models\QuestionType;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Support\JavaScript;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Contracts\Support\Renderable;

class QuestionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $option = QuestionType::getSelect();
        return Grid::make(new Question(), function (Grid $grid) use ($option) {
//            $grid->column('id')->sortable();
            $grid->number();
            $grid->hideColumns(['id']);
            $grid->column('type')->using($option);
            $grid->column('title')->display(function ($text) {
                return str_limit($text, 40, '...');
            });
            $grid->column('sort')->editable();
            $grid->column('status')->switch();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('type');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $option = QuestionType::getSelect();
        return Show::make($id, new Question(), function (Show $show) use ($option) {
            $show->field('id');
            $show->field('title');
            $show->field('type')->using($option)->label();
            $show->field('answer')->json();
            $show->field('status')->using([0 => '禁用', 1 => '启用'])->label();


            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $option = QuestionType::getSelect();

        return Form::make(new Question(), function (Form $form) use ($option) {

//            $form->confirm('您确定要提交表单吗？');
            $form->display('id');
            $form->select('type')
                ->when([2, 3], function ($form) {
                    $form->textarea('extra', '文章')->rows(4);
                })
                ->options($option)->default(1);

            $form->embedsTable('questions', '有关题目', function (NestedForm $form) {
                $form->text('question', '题干');
                $form->embedsTable('answers', '有关答案', function ($form) {
                    $form->text('answer', '答案');
                    $form->switch('is_correct', '正确答案');
                });
            });
//
//            $form->number('sort', $form->getElementId())->default(50);
//            $form->switch('status')->default(1);
//
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
