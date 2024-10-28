


<aside class="relative bg-sidebar h-screen w-72 hidden sm:block shadow-xl">
    <div class="p-6">
        <a  href="{{ route((!empty($url) ? $url : '') . '.dashboard') }}" 
            class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            {{ (!empty($url) ? strFilter($url) : "") }} Panel
        </a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a  href="{{ route((!empty($url) ? $url : '') . '.dashboard') }}" 
            class="flex items-center {{ $activeMenu == 'dashboard' ? 'active-nav-link' : '' }} text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>

        <a href="{{ route((!empty($url) ? $url : '') . '.projects') }}" class="flex items-center {{ $activeMenu == 'project' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fa fa-cogs mr-3" aria-hidden="true"></i>
            Projects
        </a>

        <a href="{{ route((!empty($url) ? $url : '') . '.employees') }}" class="flex items-center {{ $activeMenu == 'employee' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-users mr-3"></i>
            Employees
        </a>

        @if($url=="admin")

        <a href="{{ route('admin.users') }}" class="flex items-center {{ $activeMenu == 'users' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-users mr-3"></i>
            Users
        </a>

        @endif

        <a href="{{ route((!empty($url) ? $url : '') . '.recycle-bin') }}" class="flex items-center {{ $activeMenu == 'recycle-bin' ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fa fa-trash mr-3" aria-hidden="true"></i>
            Recycle Bin
        </a>

    </nav>

</aside>