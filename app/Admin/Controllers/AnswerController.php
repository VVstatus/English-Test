<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Answer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AnswerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Answer(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('is_correct');
            $grid->column('q_id');
            $grid->column('title');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
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
        return Show::make($id, new Answer(), function (Show $show) {
            $show->field('id');
            $show->field('is_correct');
            $show->field('q_id');
            $show->field('title');
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
        return Form::make(new Answer(), function (Form $form) {
            $form->display('id');
            $form->text('is_correct');
            $form->text('q_id');
            $form->text('title');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
