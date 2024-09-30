<aside class="col-lg-3 border-end">
    <nav class="nav nav-pills flex-lg-column mb-4">
        <a class="nav-link {{ (Route::current()->getName() == 'admin.profile')? 'active':'' }}" aria-current="page" href="{{ route('admin.profile') }}">General</a>
        <a class="nav-link {{ (Route::current()->getName() == 'edit.profile')? 'active':'' }}" href="{{ route('edit.profile') }}">Edit Profile</a>
        <a class="nav-link {{ (Route::current()->getName() == 'change.password')? 'active':'' }}" href="{{ route('change.password') }}">Change Password</a>
    </nav>
</aside>