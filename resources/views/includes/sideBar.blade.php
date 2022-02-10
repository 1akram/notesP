        <!-- sidebar  -->
        <div class="sidebar">
            <!-- logo  -->
            <div class="logo">
                <img src="{{asset('/img/profile_pic_ic5t.svg')}}" alt="">
                <span>{{Auth::user()->firstName." ".Auth::user()->lastName}}</span>
                <i class="fas fa-bars menu-btn js-menu-btn"></i>
            </div>
            <!-- end logo  -->
            <!-- menu  -->
            <ul class="menu">
                <!-- menu item  -->
                <li class="menu-item">
                    <a href="{{route('home')}}" class="item-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span> @lang('strings.HOME') </span>
                    </a>
                </li>
                <!-- end menu item  -->
                <!-- menu item  -->
                <li class="menu-item">
                    <a href="{{route('createNote')}}" class="item-link">
                        <i class="fas fa-plus"></i>
                        <span> @lang('strings.ADD_NOTE') </span>
                    </a>
                </li>
                <!-- end menu item  -->
                {{-- <!-- menu item  -->
                <li class="menu-item">
                    <a href="{{route('home')}}" class="item-link">
                        <i class="fas fa-plus"></i>
                        <span> @lang('strings.ADD_NOTE') </span>
                    </a>
                </li>
                <!-- end menu item  --> --}}
                <!-- menu item  -->
                <li class="menu-item">
                    <a href="{{route('logout')}}" class="item-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>تسجيل الخروج</span>
                    </a>
                </li>
                <!-- end menu item  -->
    
    
            </ul>
            <!-- end menu  -->
        </div>
        <!-- end sidebar  -->