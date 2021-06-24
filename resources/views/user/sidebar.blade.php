<div class="sidebar-dashboard">
    <div class="user-details-side">
        <div class="user-img">
            @if(Storage::exists(\Auth::user()->profile_photo))
                <img src="{{ asset('storage') }}/{{ \Auth::user()->profile_photo }}" alt="">
            @else
                <img src="{{ asset('') }}admin/images/dummy-user.jpg" alt="">
            @endif
        </div>
        <div class="user-info">
        <h4>{{ \Auth::user()->name }}</h4>
        <p><i class="fas fa-phone-alt"></i> {{ \Auth::user()->mobile_number }}</p>
        <p><i class="far fa-envelope"></i> {{ \Auth::user()->email }}</p>
        </div>
    </div>
    <ul>
        <li><a href="{{ route('user.dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('user.profile') }}" class=""><i class="far fa-address-card"></i> My Account</a></li>
        <li><a href="favourite-food.php" class=""><i class="far fa-heart"></i> favourite Food</a></li>
        <li><a href="{{ route('user.managePassword') }}" class=""><i class="fas fa-lock"></i> Change Password</a></li>
        <li><a href="{{ route('user.setting') }}" class=""><i class="fas fa-cogs"></i> Account Setting</a></li>
        <li><a href="{{ url('user/address/book') }}" class=""><i class="fas fa-book"></i> Address Book</a></li>
        <li><a href="refer-earn.php" class=""><i class="fas fa-share-alt"></i> Invite Friends<br><small>(invite your friends to earn $5)</small></a></li>
        <li><a href="{{ route('user.logout') }}" class=""><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
    <div class="last-login"><b>Last activity:</b> {{ \App\Helper\Helper::convertDateTime(\Auth::user()->updated_at) }}</div>
</div>