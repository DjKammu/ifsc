<?php

namespace App\Admin\Controllers;

use App\City;
use App\State;
use App\District;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cities';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new City());

        $grid->column('id', __('Id'));
        $grid->state()->display(function ($state) {
            return $state['name'];
        });
        $grid->district()->display(function ($district) {
            return $district['name'];
        });
        
        $grid->column('name', __('Name'));
        //$grid->column('slug', __('Slug'));
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
        $show = new Show(City::findOrFail($id));

        $show->field('id', __('Id'));
        $show->state_id('State')->as(function ($state_id) {
            return State::find($state_id)->name;
        });
        $show->district_id('District')->as(function ($district_id) {
            return District::find($district_id)->name;
        });

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
        $form = new Form(new City());

        $states = State::pluck('name','id');

        $districts = District::pluck('name','id');

        $form->select('state_id', __('State'))->options($states)->load('district_id', '/admin/state/districts')->rules('required');

        $form->select('district_id', __('District'))->options($districts)->rules('required');

        $form->text('name', __('Name'))->rules('required|min:3');
        
        $form->hidden('slug');

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
