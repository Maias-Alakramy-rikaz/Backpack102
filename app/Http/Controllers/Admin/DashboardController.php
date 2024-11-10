<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Charts\MyChart;

use Illuminate\Routing\Controller;
use Backpack\CRUD\app\Library\Widget;
/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DashboardController extends Controller
{
    public function index()
    {
        $stuentdCount = Student::All()->count();
        $teacherCount = Teacher::All()->count();
        $courseCount = Course::All()->count();
        
        Widget::add([
            'type'    => 'div',
            'class'   => 'row',
            'content' => [ // widgets
                [
                    'type' => 'card',
                    'class'   => 'card bg-secondary text-white',
                    'content' => [
                        'header' =>"Number of Students",
                        'body' => "".$stuentdCount." Student."],
                ],
                [
                    'type' => 'card',
                    'class'   => 'card bg-secondary text-white',
                    'content' => [
                        'header' =>"Number of Teachers",
                        'body' => "".$teacherCount." Teacher."],
                ],
                [
                    'type' => 'card',
                    'class'   => 'card bg-secondary text-white',
                    'content' => [
                        'header' =>"Number of Courses",
                        'body' => "".$courseCount." Course."],
                ],
            ],
        ])->to('before_content');

        $teachers = Teacher::withSum('courses', 'price')->get();
        $teacherNames = $teachers->pluck('name');
        $totalCoursePrices = $teachers->pluck('courses_sum_price');

        $teachersChart = new MyChart;
        $teachersChart->labels($teacherNames);
        $teachersChart->dataset('TeacherRevenue', 'bar', $totalCoursePrices);
        return view('admin.dashboard', [
            'teachersChart' => $teachersChart,
            'title' => 'Dashboard',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'Dashboard' => false,
            ],
            'page' => 'resources/views/admin/dashboard.blade.php',
            'controller' => 'app/Http/Controllers/Admin/DashboardController.php',
        ]);
    }
}
