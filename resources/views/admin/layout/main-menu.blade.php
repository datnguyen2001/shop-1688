<?php
$user_id = Auth::guard('admin')->id();
$role = \App\Models\RoleModel::where('user_id', $user_id)->first();
if ($role){
    $arr = json_decode($role->arr_role);
}
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @foreach(config('menu_aside.admin') as $menu)
            @if(in_array($menu['number'], $arr))
                @if(count($menu['submenu'])>0)
                    <li class="nav-item">
                        <a class="nav-link @if($menu['name'] != $page_menu) collapsed @endif" data-bs-target="#forms-{{$menu['name']}}" data-bs-toggle="collapse" href="#"
                           @if($menu['name'] == $page_menu) aria-expanded="true" @endif>
                            <i class="{{ $menu['icon'] }}"></i><span>{{ $menu['title'] }}</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="forms-{{$menu['name']}}" class="nav-content @if($menu['name'] != $page_menu) collapse @else show @endif " data-bs-parent="#sidebar-nav">
                            @foreach($menu['submenu'] as $submenu)
                                <li>
                                    <a @if(!empty($submenu['parameters'])) href="{{route($submenu['route'], $submenu['parameters'])}}" @else href="{{route($submenu['route'])}}" @endif class="@if($submenu['name'] == $page_sub) active @endif">
                                        <i class="bi bi-circle"></i><span>{{$submenu['title']}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    @if(!empty($menu['route']))
                        <li class="nav-item">
                            <a class="nav-link @if($menu['name'] != $page_menu) collapsed @endif"  @if(!empty($menu['parameters'])) href="{{ route($menu['route'], $menu['parameters']) }}" @else href="{{ route($menu['route']) }}" @endif>
                                <i class=" {{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link @if($menu['name'] != $page_menu) collapsed @endif" href="#">
                                <i class=" {{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif
        @endforeach
    </ul>
</aside>
