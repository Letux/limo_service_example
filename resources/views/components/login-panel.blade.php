<div align="right" class="login_panel">
    @auth
        <a href="{{ route('step1') }}" class="btn btn-default">New Order</a>
        <a href="{{ route('my_orders') }}" class="btn btn-default">Orders</a>
        <a href="{{ route('profile.edit') }}" class="btn btn-default">Profile</a>
        <a href="{{ route('logout') }}" class="btn btn-default">Log Out</a>
    @else
        <a href="{{ route('login') }}" class="btn btn-default">Log In</a>
    @endauth
</div>
