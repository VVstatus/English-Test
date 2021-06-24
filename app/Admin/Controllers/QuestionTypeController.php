<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\QuestionType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class QuestionTypeController extends AdminController
{
    protected $title = '题型';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new QuestionType(), function (Grid $grid) {
            $grid->model()->orderBy('sort', 'asc')->orderBy('id', 'asc');
            $grid->column('id')->sortable();
            $grid->column('title');

            $grid->column('sort');
            $grid->column('status')
                ->using([0 => '禁用', 1 => '启用'])
                ->label([0 => 'danger', 1 => 'success']);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('title','题型');
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
        return Show::make($id, new QuestionType(), function (Show $show) {
            $show->field('id');
            $show->field('sort');
            $show->field('status');
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
        return Form::make(new QuestionType(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->switch('status')->default(1);

            $form->number('sort')->default(50);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }


}
