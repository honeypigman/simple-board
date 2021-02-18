<!-- https://feathericons.com/ -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item @if(Request::segment(2)=='') bg-warning @endif">
                <a class="nav-link" aria-current="page" href="/admin/">
                <span data-feather="home"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item @if(Request::segment(2)=='board') bg-warning @endif">
                <a class="nav-link" href="/admin/board">
                <span data-feather="list"></span>
                board
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Management Items</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item @if(Request::segment(2)=='users') bg-warning @endif">
                <a class="nav-link" href="/admin/users">
                <span data-feather="users"></span>
                Users
                </a>
            </li>
            <li class="nav-item @if(Request::segment(2)=='access') bg-warning @endif">
                <a class="nav-link" href="/admin/access">
                <span data-feather="file-text"></span>
                Access log
                </a>
            </li>
            <li class="nav-item @if(Request::segment(2)=='setting') bg-warning @endif">
                <a class="nav-link" href="/admin/setting">
                <span data-feather="settings"></span>
                Setting Info
                </a>
            </li>                        
        </ul>

        <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Current month
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Last quarter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Social engagement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Year-end sale
                </a>
            </li>
        </ul> -->
    </div>
</nav>