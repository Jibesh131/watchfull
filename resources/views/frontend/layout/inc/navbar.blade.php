<nav>
    <div class="nav-container" id="nav-container">
        <div style="display: flex; align-items: center;">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search ...">
            </div>
        </div>

        @auth
        <div class="header-right">
            <div class="icon-btn">
                <a href="javascript:">
                    <i class="far fa-envelope"></i>
                </a>
            </div>
            <div class="icon-btn">
                <i class="far fa-bell"></i>
                <span class="badge">2</span>
            </div>
            <div class="icon-btn">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="user-profile" id="userProfile">
                <div class="user-avatar">H</div>
                <span class="user-name">Hi, Hizrian</span>

                <div class="dropdown-menu">
                    <ul>
                        <li><a href="#">My Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endauth
        @guest
        <div class="header-right login-part">
            <button class="btn btn-primary ">Sign Up</button>
            <button class="btn btn-secondary">Log In</button>
        </div>
        @endguest
    </div>
</nav>