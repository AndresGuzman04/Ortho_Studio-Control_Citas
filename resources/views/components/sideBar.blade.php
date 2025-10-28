<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo" style="width: 50px; height: 50px;">
                </div>
                <div class="sidebar-brand-text mx-3">Ortho Studio </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pacientes -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('pacientes.index')}}">
                    <i class="fas fa-fw fa-user-injured"></i>
                    <span>Pacientes</span>
                </a>
            </li>

            <!-- Nav Item - Citas -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('citas.index')}}">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Citas</span>
                </a>
            </li>

            <!-- Nav Item - Usuarios -->
            <li class="nav-item">
                <a class="nav-link" href="usuarios.html">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <!-- Nav Item - Roles -->
            <li class="nav-item">
                <a class="nav-link" href="roles.html">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>Roles</span>
                </a>
            </li>

            <!-- Nav Item - Empresa -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('empresa.index') }}">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Empresa</span>
                </a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>