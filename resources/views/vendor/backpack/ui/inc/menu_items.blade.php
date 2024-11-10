{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="كورسات" icon="la la-tag" :link="backpack_url('course')" />
<x-backpack::menu-item title="طلاب" icon="la la-tag" :link="backpack_url('student')" />
<x-backpack::menu-item title="أساتذة" icon="la la-tag" :link="backpack_url('teacher')" />
<x-backpack::menu-item title="حضور كورس" icon="la la-question" :link="backpack_url('course-student')" />