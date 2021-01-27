<!-- Sidebar outter -->
<div class="main-sidebar">
    <!-- sidebar wrapper -->
    <aside id="sidebar-wrapper">
        <!-- sidebar brand -->
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <!-- menu header -->
            <li class="menu-header">General</li>
            <!-- menu item -->
            <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @php
                $renderMenus = RenderMenus::appendMenus();
                echo $renderMenus;
            @endphp
            <li class="{{ Route::is('form') ? 'active' : '' }}">
                <a href="{{ route('form') }}">
                    <i class="fas fa-file"></i>
                    <span>Form</span>
                </a>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Level 1</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">Level 1.1</a></li>
                <li class="nav-item dropdown"><a class="nav-link has-dropdown" href="#">Level 1.2</a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Level 1.2.1</a></li>
                        <li><a class="nav-link" href="#">Level 1.2.2</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link has-dropdown" href="#">Level 1.3</a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Level 1.3.1</a></li>
                        <li class="nav-item dropdown"><a class="nav-link has-dropdown" href="#">Level 1.3.2</a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="#">Level 1.3.2.1</a></li>
                              <li><a class="nav-link" href="#">Level 1.3.2.2</a></li>
                          </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link has-dropdown" href="#">Level 1.4</a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="#">Level 1.4.1</a></li>
                        <li class="nav-item dropdown"><a class="nav-link has-dropdown" href="#">Level 1.4.2</a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="#">Level 1.4.2.1</a></li>
                              <li class="nav-item dropdown"><a class="nav-link has-dropdown" href="#">Level 1.4.2.2</a>
                                  <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="#">Level 1.4.2.2.1</a></li>
                                    <li><a class="nav-link" href="#">Level 1.4.2.2.2</a></li>
                                  </ul>
                              </li>
                          </ul>
                        </li>
                    </ul>
                </li>
              </ul>
            </li>
        </ul>
    </aside>
</div>
