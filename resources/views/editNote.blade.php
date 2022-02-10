@extends('mainLayout.main')
@section('pageTitle'  )
@lang('strings.EDIT_NOTE')
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
                    <div class="header">@lang('strings.EDIT_NOTE') </div>
                    <div class="body">
                        <form action="{{route('updateNote',['id'=>$note->id])}}" method="POST" enctype="multipart/form-data" >
                            <!-- alert messege -->
                            @include('includes.alertMsg')
                            <!-- end alert messege  -->
                            @csrf
                             <div class="cover ">
                                 <img src="{{asset($note->image->url)}}" alt="{{$note->content}}">
                             </div>
                             <input type="file"   class="input" accept="image/png, image/jpg, image/jpeg" name="image" id="">
                            <select class='input'   name="type" id="">
                                <option @if ($note->type =='normal')
                                    selected
                                @endif value="normal">@lang('strings.TYPES.normal')</option>
                                <option @if ($note->type=='urgent')
                                selected
                                @endif  value="urgent">@lang('strings.TYPES.urgent')</option>
                                <option @if ($note->type=='on-date')
                                selected
                                @endif  value="on-date">@lang('strings.TYPES.on-date')</option>
                            </select>
                            <textarea name="content" placeholder="@lang('strings.CONTENT')"   class="input" id="" cols="30" rows="5">{{$note->content}}</textarea>
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



