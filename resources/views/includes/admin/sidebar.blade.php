<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SMK Indonesia</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SMK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
            <li class="{{ setActive('admin/dashboard') }}">
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('posts.index')
                <li class="{{ setActive('admin/post') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book-open"></i>
                        <span>Berita</span>
                    </a>
                </li>
            @endcan

            @can('tags.index')
                <li class="{{ setActive('admin/tag') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <span>Tag</span>
                    </a>
                </li>
            @endcan

            @can('categories.index')
                <li class="{{ setActive('admin/category') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-folder"></i>
                        <span>Kategori</span>
                    </a>
                </li>
            @endcan

            @can('events.index')
                <li class="{{ setActive('admin/event') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bell"></i>
                        <span>Agenda</span>
                    </a>
                </li>
            @endcan

            @if (auth()->user()->can('photos.index') ||
    auth()->user()->can('videos.index'))
                <li class="menu-header">Galeri</li>
            @endif

            @can('photos.index')
                <li class="{{ setActive('admin/photo') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-image"></i>
                        <span>Foto</span>
                    </a>
                </li>
            @endcan

            @can('videos.index')
                <li class="{{ setActive('admin/video') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-video"></i>
                        <span>Video</span>
                    </a>
                </li>
            @endcan

            @if (auth()->user()->can('roles.index') ||
    auth()->user()->can('permission.index') ||
    auth()->user()->can('users.index'))
                <li class="menu-header">Pengaturan</li>
            @endif

            @can('sliders.index')
                <li class="{{ setActive('admin/slider') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-laptop"></i>
                        <span>Sliders</span>
                    </a>
                </li>
            @endcan

            <li
                class="dropdown {{ setActive('admin/role') . setActive('admin/permission') . setActive('admin/user') }}">
                @if (auth()->user()->can('roles.index') ||
    auth()->user()->can('permission.index') ||
    auth()->user()->can('users.index'))
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-users"></i>
                        <span>Users Management</span>
                    </a>
                @endif

                <ul class="dropdown-menu">
                    @can('roles.index')
                        <li class="{{ setActive('admin/role') }}">
                            <a href="{{ route('admin.role.index') }}" class="nav-link">
                                <i class="fas fa-unlock"></i>
                                <span>Roles</span>
                            </a>
                        </li>
                    @endcan

                    @can('permissions.index')
                        <li class="{{ setActive('admin/permission') }}">
                            <a href="{{ route('admin.permission.index') }}" class="nav-link">
                                <i class="fas fa-key"></i>
                                <span>Permissions</span>
                            </a>
                        </li>
                    @endcan

                    @can('users.index')
                        <li class="{{ setActive('admin/user') }}">
                            <a href="{{ route('admin.user.index') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

        </ul>
    </aside>
</div>
