<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="/home" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Add Board</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('task')}}" class="nav-link">
                <i class="nav-icon far fa-circle text-success"></i>
                <p>Add Task</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('board.show')}}" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Kanban System view</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="nav-icon far fa-circle text-warning"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</nav>