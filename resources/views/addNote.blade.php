@extends('mainLayout.main')
@section('pageTitle'  )
@lang('strings.ADD_NOTE')
@endsection
@section('customCSS')

@endsection
@section('content')
        @include('includes.sideBar')


        <!-- main content  -->
        <div class="main-content">
            
            <!-- notes section  -->
            <div class="section container">
                <div class="notes list-box">
                    <div class="header">@lang('strings.ADD_NOTE') </div>
                    <div class="body">
                        <form action="{{route('saveNote')}}" method="POST" enctype="multipart/form-data" >
                            <!-- alert messege -->
                            @include('includes.alertMsg')
                            <!-- end alert messege  -->
                            @csrf
                             <input type="file"   class="input" accept="image/png, image/jpg, image/jpeg" name="image" id="">
                            <select class='input'   name="type" id="">
                                <option @if (old('type')=='normal')
                                    selected
                                @endif value="normal">@lang('strings.TYPES.normal')</option>
                                <option @if (old('type')=='urgent')
                                selected
                                @endif  value="urgent">@lang('strings.TYPES.urgent')</option>
                                <option @if (old('type')=='on-date')
                                selected
                                @endif  value="on-date">@lang('strings.TYPES.on-date')</option>
                            </select>
                            <textarea name="content" placeholder="@lang('strings.CONTENT')"   class="input" id="" cols="30" rows="5">{{old('content')}}</textarea>
                            <input type="submit" value="@lang('strings.SUBMIT')" class="input btn">
                        </form>
                    </div>

                </div>
            </div>
            <!-- end notes section  -->
            @include('includes.copyRight')
       
        </div>
        <!-- end main content  -->


@endsection

@section('customJS')
    
    
@endsection



