<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Course::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course');
        CRUD::setEntityNameStrings('كورس', 'كورسات');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.
        CRUD::modifyColumn('price', ['label'=>'السعر','suffix'=>'$']);
        CRUD::modifyColumn('name', ['label'=>'الاسم']);
        CRUD::modifyColumn('start_date', ['label'=>'تاريخ البدء']);
        CRUD::removeColumn('teacher_id');
        CRUD::column(['name'=>'Teacher','label'=>'أستاذ']);
        CRUD::column([
            // relationship count
            'name'      => 'students', // name of relationship method in the model
            'type'      => 'relationship_count',
            'label'     => 'عدد الطلاب المسجلين', // Table column heading
            // OPTIONAL
            'suffix' => ' طالب', // to show "123 tags" instead of "123 items"
        ]);

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);
        // CRUD::setFromDb(); // set fields from db columns.
        CRUD::field(['label'=>'الاسم','name'=>'name']);
        CRUD::field(['label'=>'الاسم','name'=>'price','prefix'=>'$']);
        CRUD::field([
            'name'  => 'start_date', // The db column name
            'label' => 'تاريخ البدء', // Table column heading
            'type'  => 'date',
            ]);
        CRUD::field('teacher_id')
            ->type('select')->model('App\Models\Teacher')->label('الأستاذ');
        CRUD::field([   
            'label'     => "الطلاب",
            'type'      => 'select_multiple',
            'name'      => 'students', // the method that defines the relationship in your Model
            ]);

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
