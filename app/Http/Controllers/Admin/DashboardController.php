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
                        'header' =>"عدد الطلاب المسجلين",
                        'body' => "".$stuentdCount." طالب."],
                ],
                [
                    'type' => 'card',
                    'class'   => 'card bg-secondary text-white',
                    'content' => [
                        'header' =>"عدد الأساتذة المسجلين",
                        'body' => "".$teacherCount." أستاذ."],
                ],
                [
                    'type' => 'card',
                    'class'   => 'card bg-secondary text-white',
                    'content' => [
                        'header' =>"عدد الكورسات المتوافرة",
                        'body' => "".$courseCount." كورس."],
                ],
            ],
        ])->to('before_content');

        $teachers = Teacher::with('courses.students')->get();
        $fullNames = $teachers
        ->map(function ($teacher) {
            return $teacher->first_name . ' ' . $teacher->last_name;
        });
        $revenues = $teachers
        ->map(function ($teacher) {
            return $teacher->courses
            ->sum(function ($course){
                return $course->price * $course->students->count();
                });
            });
        
        $teachersChart = new MyChart;
        $teachersChart->labels($fullNames);
        $teachersChart->dataset('أرباح الاساتذة', 'bar', $revenues);

        return view('admin.dashboard', [
            'teachersChart' => $teachersChart,
            'title' => 'لوحة التحكم',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'لوحة التحكم' => false,
            ],
            'page' => 'resources/views/admin/dashboard.blade.php',
            'controller' => 'app/Http/Controllers/Admin/DashboardController.php',
        ]);
    }
}
