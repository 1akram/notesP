<!-- login form  -->
<form action="{{route('loginAuth')}}" method="post">
    @csrf
    <!-- avatar  -->
    <div class="avatar-holder">
        
        <img src="{{asset('img/profile_pic_ic5t.svg')}}">
    </div>
    <!-- end avatar  -->

    <!-- alert messege -->
    @include('includes.alertMsg')
    <!-- end alert messege  -->

    <input class="input "  type="email" value="{{ old('email') }}" name="email" placeholder="البريدالالكتروني">
    <div class="form-element">
        <input class="input"  type="password" name="password" placeholder="الرقم السري ">
        <span><i class="fas fa-eye-slash js-eye-icon  color-second"></i></span>
    </div>
    <input type="submit" class="input btn" value="تسجيل الدخول">
    <a href="{{route('register')}}" class=" btn">انشاء حساب</a>
</form>
<!-- end login form  -->