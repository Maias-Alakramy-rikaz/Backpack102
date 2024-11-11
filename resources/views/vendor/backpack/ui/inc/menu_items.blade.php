{{-- This file is used for menu items by any Backpack v6 theme --}}
@if(backpack_user()->can('show-dashboard'))
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@endif

@if(backpack_user()->hasAnyPermission(['manage-users','manage-roles','manage-permissions']))
<x-backpack::menu-dropdown title="إدارة مستخدمين" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown-header title="الإدارة" />
    
    @if(backpack_user()->can('manage-users'))
    <x-backpack::menu-dropdown-item title="مستخدمين" icon="la la-user" :link="backpack_url('user')" />
    @endif

    @if(backpack_user()->can('manage-roles'))
    <x-backpack::menu-dropdown-item title="أدوار" icon="la la-group" :link="backpack_url('role')" />
    @endif
    
    @if(backpack_user()->can('manage-permissions'))
    <x-backpack::menu-dropdown-item title="صلاحيات" icon="la la-key" :link="backpack_url('permission')" />
    @endif

</x-backpack::menu-dropdown>
@endif

<x-backpack::menu-item title="كورسات" icon="la la-tag" :link="backpack_url('course')" />
<x-backpack::menu-item title="طلاب" icon="la la-tag" :link="backpack_url('student')" />
<x-backpack::menu-item title="أساتذة" icon="la la-tag" :link="backpack_url('teacher')" />
<x-backpack::menu-item title="حضور كورس" icon="la la-question" :link="backpack_url('course-student')" />