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
            @foreach( Code::get('NAVBAS') as $code=>$name )
            <li class="nav-item @if(Request::segment(2)==($code)) bg-warning @endif">
                <a class="nav-link" href="/admin/{{ $code }}">
                @if( !empty(Code::get('NAVIMG')[$code]) )
                    <span data-feather="{{ Code::get('NAVIMG')[$code] }}"></span>
                @else
                    <span data-feather="alert-octagon"></span>
                @endif
                {{ $name }}
                </a>
            </li>
            @endforeach
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Management</span>
        </h6>
        <ul class="nav flex-column mb-2">
            @foreach( Code::get('NAVSYS') as $code=>$name )
            <li class="nav-item @if(Request::segment(2)==($code)) bg-warning @endif">
                <a class="nav-link" href="/admin/{{ $code }}">
                @if( !empty(Code::get('NAVIMG')[$code]) )
                    <span data-feather="{{ Code::get('NAVIMG')[$code] }}"></span>
                @else
                    <span data-feather="alert-octagon"></span>
                @endif
                {{ $name }}
                </a>
            </li>
            @endforeach                   
        </ul>
    </div>
</nav>