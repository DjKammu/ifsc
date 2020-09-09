<?php

namespace App\Admin\Controllers;

use App\Location;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LocationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Location';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Location());

        $grid->column('id', __('Id'));
        $grid->column('path', __('Path'))->link();
        $grid->column('count', __('Count'));
        $grid->column('ip', __('Ip'));
        $grid->column('location_data', __('Location data'))->display( function($data) {
              if(empty($data)){ return;}
              $data = json_decode($data,true);
              $htm = 'Country :<b> '.$data['countryName'].'</b></br>';
              $htm .= 'Region :<b> '.$data['regionName'].'</b></br>';
              $htm .= 'City :<b> '.$data['cityName'].'</b></br>';
              $htm .= 'Zip Code :<b> '.$data['zipCode'].'</b>';
              return $htm;
        });
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Location::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('path', __('Path'))->link();
        $show->field('count', __('Count'));
        $show->field('ip', __('Ip'));
        $show->field('location_data', __('Location data'))->as( function($data) {
              if(empty($data)){ return;}
              $data = json_decode($data,true);
              $htm = 'Country : '.$data['countryName'].', ';
              $htm .= 'Region : '.$data['regionName'].', ';
              $htm .= 'City : '.$data['cityName'].', ';
              $htm .= 'Zip Code : '.$data['zipCode'];
              return $htm;
        });
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
        $form = new Form(new Location());

        $form->text('path', __('Path'));
        $form->number('count', __('Count'))->default(1);
        $form->ip('ip', __('Ip'));
        $form->textarea('location_data', __('Location data'));

        return $form;
    }
}
