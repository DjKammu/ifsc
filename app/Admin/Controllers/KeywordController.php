<?php

namespace App\Admin\Controllers;

use App\Keyword;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KeywordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Keyword';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Keyword());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        //$grid->column('slug', __('Slug'));
        $grid->column('universal')->using(['1' => Keyword::YES, '0' => Keyword::NO]);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Keyword::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        //$show->field('slug', __('Slug'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Keyword());

        $form->text('name', __('Name'))->rules('required|min:3');
        //$form->text('slug', __('Slug'));
        $form->hidden('slug');
        
       
        $states = [
            'on'  => ['value' => 1, 'text' => Keyword::YES],
            'off' => ['value' => 0, 'text' => Keyword::NO]
        ];         

        $form->switch('universal')->states($states)->default(Keyword::NO);

        $form->saving(function (Form $form){
            if(\request()->isMethod('POST')) {
                if ($form->slug == null) {
                    $slug = preg_replace('/(\d){1,}\.?(\d?){1,}\.?(\d?){1,}\.?(\d?){1,}/', '',
                     $form->name);
                    $form->slug = \Str::slug($slug);
                }
            }
        });

        return $form;
    }
}
