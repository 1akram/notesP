@extends('mainLayout.main')
@section('pageTitle'  )
{{'تسجيل/دخول'}}
@endsection
@section('customCSS')

@endsection
@section('content')
 
<div class="login-holder">
    <div class="row">
      
        <div class="col-sm-12">
           @includeWhen( Route::current()->getName()=='login', 'includes.loginForm' )
           @includeWhen( Route::current()->getName()=='register', 'includes.registerForm' )
        </div>
    </div>

</div>


@endsection

@section('customJS')
 
 
@endsection