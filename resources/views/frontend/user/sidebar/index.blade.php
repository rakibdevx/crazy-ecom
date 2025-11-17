<div class="col-lg-3 col-md-4">
    <div class="myaccount-tab-menu nav nav">
        <a href="{{route('user.dashboard')}}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}" ><i class="fa fa-dashboard"></i>Dashboard</a>
        <a href="#orders"><i class="fa fa-cart-arrow-down"></i> Orders</a>
        <a href="#download"><i class="fa fa-cloud-download"></i> Download</a>
        <a href="#payment-method"><i class="fa fa-credit-card"></i> Payment Method</a>
        <a href="#address-edit"><i class="fa fa-map-marker"></i> address</a>
        <a href="#account-info"><i class="fa fa-user"></i> Account Details</a>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> Logout
        </a>

    </div>
</div>
