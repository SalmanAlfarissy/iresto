<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="{{ asset('admin/images/profile/pic1.png') }}" width="20" alt="">
                    <div class="header-info ms-3">
                        <?php $name=Auth::user(); ?>
                        <span class="font-w600 ">{{ $name->firstname." ".$name->lastname }}<b></b></span>
                        <small class="text-center font-w400">{{ $name->status }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ms-2">Logout </span>
                    </a>
                </div>
            </li>
            <?php
                $status = Auth::user()->status;
            ?>
            @if ($status == 'admin' || $status == 'user')
            <li class="{{ request()->is('dashboard') ? 'mm-active' : '' }}"><a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="{{ request()->is('user') ? 'mm-active' : '' }}"><a href="{{ route('user') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-user"></i>
                    <span class="nav-text">User</span>
                </a>
            </li>

            <li class="{{ request()->is('menu/admin') ? 'mm-active' : '' }}"><a href="{{ route('menu-admin') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-043-menu"></i>
                    <span class="nav-text">Menu</span>
                </a>
            </li>

            <li class="{{ request()->is('transaction/admin') ? 'mm-active' : '' }}"><a href="{{ route('transaction-admin') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list-1"></i>
                    <span class="nav-text">Transaction</span>
                </a>
            </li>
            @endif

            @if ($status == 'customer')
            <li class="{{ request()->is('mywalet') ? 'mm-active' : '' }}"><a href="{{ route('mywallet') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-id-card"></i>
                    <span class="nav-text">My Wallet</span>
                </a>
            </li>

            <li class="{{ request()->is('menu') ? 'mm-active' : '' }}"><a href="{{ route('menu') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-043-menu"></i>
                    <span class="nav-text">Menu</span>
                </a>
            </li>

            <li class="{{ request()->is('ledger-balance') ? 'mm-active' : '' }}"><a href="{{ route('ledger-balance') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-notebook-2"></i>
                    <span class="nav-text">Ledger Balance</span>
                </a>
            </li>

            <li class="{{ request()->is('transaction') ? 'mm-active' : '' }}"><a href="{{ route('transaction') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list-1"></i>
                    <span class="nav-text">Transaction</span>
                </a>
            </li>

            @endif

        </ul>

    </div>
</div>
