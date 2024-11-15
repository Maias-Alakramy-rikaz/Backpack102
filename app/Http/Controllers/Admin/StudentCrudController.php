<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('طالب', 'طلاب');

        if (!backpack_user()->can('manage-students')) {
            abort(403, 'غير مخول بالدخول.');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // set columns from db columns.
        CRUD::column(['name'=>'full_name', 'label'=>'الاسم الكامل']);
        CRUD::column(['name'=>'birthday', 'label'=>'تاريخ الميلاد']);
        CRUD::column([
            // relationship count
            'name'      => 'courses', // name of relationship method in the model
            'type'      => 'relationship_count',
            'label'     => 'عدد الكورسات المسجلة', // Table column heading
            // OPTIONAL
            'suffix' => ' كورس', // to show "123 tags" instead of "123 items"
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
        CRUD::setValidation(StudentRequest::class);
        CRUD::setFromDb(); // set fields from db columns. 
        CRUD::modifyField('first_name', ['label'=>'الاسم']);
        CRUD::modifyField('last_name', ['label'=>'الكنية']);
        CRUD::modifyField('birthday', ['label'=>'تاريخ الميلاد']); 
        CRUD::field([   
            'label'     => "كورسات مسجلة",
            'type'      => 'select_multiple',
            'name'      => 'courses', // the method that defines the relationship in your Model
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
