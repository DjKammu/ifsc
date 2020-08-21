<?php

namespace App\Admin\Controllers;
use Encore\Admin\Layout\Content;
use App\Imports\BranchImport;
use Illuminate\Http\Request;
use App\City;
use App\Bank;
use App\State;
use App\Branch;
use App\District;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;


class BranchController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Branches';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Branch());

        $grid->header(function ($query) {
            return '<a href="'.route('admin.branches.import').'" class="btn btn-sm btn-success" title="Import Excel">
                <i class="fa fa-upload"></i><span class="hidden-xs">&nbsp;&nbsp;Import Excel</span>
            </a>';
        });


        $grid->column('id', __('Id'));
        $grid->bank()->display(function ($bank) {
            return $bank['name'];
        });
        $grid->state()->display(function ($state) {
            return $state['name'];
        });

        $grid->district()->display(function ($district) {
            return $district['name'];
        }); 
        
        $grid->city()->display(function ($city) {
            return $city['name'];
        });

        $grid->column('ifsc_code', __('Ifsc code'));
        $grid->column('branch', __('Branch'));
        //$grid->column('slug', __('Slug'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
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
        $show = new Show(Branch::findOrFail($id));

        $show->field('id', __('Id'));


        $show->bank_id('Bank')->as(function ($state_id) {
            return Bank::find($state_id)->name;
        });

        $show->state_id('State')->as(function ($state_id) {
            return State::find($state_id)->name;
        });
        $show->district_id('District')->as(function ($district_id) {
            return District::find($district_id)->name;
        });

        $show->city_id('City')->as(function ($district_id) {
            return City::find($district_id)->name;
        });

        $show->field('ifsc_code', __('Ifsc code'));
        $show->field('branch', __('Branch'));
        //$show->field('slug', __('Slug'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
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
        $form = new Form(new Branch());

        $banks = Bank::pluck('name','id');

        $form->select('bank_id', __('Bank'))->options($banks)->rules('required');

        $states = State::pluck('name','id');

        $districts = District::pluck('name','id');

        $cities = City::pluck('name','id');
        
        $form->select('state_id', __('State'))->options($states)->load('district_id', '/admin/state/districts')->rules('required');

        $form->select('district_id', __('District'))->options($districts)->load('city_id', '/admin/district/cities')->rules('required');

        $form->select('city_id', __('City'))->options($cities)->rules('required');


        $form->text('ifsc_code', __('Ifsc Code'))->required()->rules(function ($form) {
                    return 'required|unique:branches,ifsc_code,'.$form->model()->id.',id';
        });

        $form->text('branch', __('Branch'))->rules('required|min:3');
        
        $form->textarea('address', __('Address'));
        $form->text('phone', __('Phone'));

        $form->hidden('slug');

        $form->saving(function (Form $form){
            if(\request()->isMethod('POST')) {
                if ($form->slug == null) {
                    $slug = preg_replace('/(\d){1,}\.?(\d?){1,}\.?(\d?){1,}\.?(\d?){1,}/', '',
                     $form->branch);
                    empty($slug) ?? $slug = $form->branch; 
                    $form->slug = \Str::slug($slug);
                }
            }
        });


        return $form;
    }

    public function getImport(Content $content)
    {
        $content->header('Import Branches Excel Here');

         // add breadcrumb since v1.5.7
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => '/admin'],
            ['text' => 'Branches', 'url' => '/admin/import/branches'],
            ['text' => 'Import']
        );

        return $content->view('admin.import', []);
    }

    public function postImport(Request $request)
    {
       set_time_limit(0);
       $array = \Excel::toArray(new BranchImport, $request->file('import'));
    
       $branches = collect($array[0])->map(function($branch){
        $branch['slug'] = \Str::slug(trim($branch['office']), '-');
        return $branch;
      })->chunk(1000)->toArray();
      

      foreach ($branches as $key => $chunk) {
        self::insertBranch($chunk);
      }

      admin_toastr('The branches have been imported successfully.', 'success');
      return redirect(route('admin.branches.index'));
      
    }

    public static function insertBranch($data){
         foreach ($data as $key => $branch) {
          $district_name = trim($branch['district']);
          $bank_name     = trim($branch['bank_name']);
          $micr_code     = isset($branch['micr_code']) ?  trim($branch['micr_code']) : '';
          $std_code      = isset($branch['std_code']) ?  trim($branch['std_code']) : '';
          $state_name    = trim($branch['state']);
          $city_name     = trim($branch['city']);
          $address       = trim($branch['address']);
          $ifsc_code     = trim($branch['ifsc']);
          $office        = trim($branch['office']);
          $phone         = trim($branch['phone']);
          $slug          = trim($branch['slug']);

          $bank = Bank::firstOrCreate(
              ['name' => $bank_name],
              ['slug' =>  \Str::slug(trim($bank_name), '-')]
          );
          $bank_id = $bank->id;

          $state = State::firstOrCreate(
              ['name' => $state_name],
              ['slug' =>  \Str::slug(trim($state_name), '-')]
          );
          $state_id = $state->id;

          $district = District::firstOrCreate(
              ['name' => $district_name,'state_id' => $state_id],
              ['slug' =>  \Str::slug(trim($district_name), '-')]
          );
          $district_id = $district->id; 

          $city = City::firstOrCreate(
              ['name' => $city_name,'state_id' => $state_id,'district_id' => $district_id],
              ['slug' =>  \Str::slug(trim($city_name), '-')]
          );
          $city_id = $city->id; 

          Branch::firstOrCreate(
              ['branch' => $office,'state_id' => $state_id,'district_id' => $district_id,
              'city_id' => $city_id,'bank_id' => $bank_id],
              ['slug' =>  $slug,'address' => $address,'phone' => $phone,'ifsc_code' => $ifsc_code,
              'micr_code' => $micr_code,'std_code' => $std_code]
          );

         }
    }

}
