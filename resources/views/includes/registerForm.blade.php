<!-- register form  -->
<form action="{{route('registerSave')}}" method="post">
    @csrf
    <!-- avatar  -->
    <div class="avatar-holder">
        
        <img src="{{asset('img/profile_pic_ic5t.svg')}}">
    </div>
    <!-- end avatar  -->
    <!-- alert messege -->
    @include('includes.alertMsg')
    <!-- end alert messege  -->
    <input class="input " value="{{ old('firstName') }}"   type="text" name="firstName" placeholder="الاسم">
    <input class="input " value="{{ old('lastName') }}" type="text" name="lastName" placeholder="اللقب">
    <input class="input "  type="email" value="{{ old('email') }} " name="email" placeholder="البريدالالكتروني">
    <div class="form-element">
        <input class="input"  type="password" name="password" placeholder="الرقم السري ">
        <span><i class="fas fa-eye-slash js-eye-icon  color-second"></i></span>
    </div>
    <div class="form-element">
        <input class="input"  type="password" name="password_confirmation" placeholder="تأكيد الرقم السري">
        <span><i class="fas fa-eye-slash js-eye-icon  color-second"></i></span>
    </div>
    <input type="submit" class="input btn" value="تسجيل">
    <a href="{{route('login')}}" class=" btn">دخول</a>
</form>
<!-- end register form  -->