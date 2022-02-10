@extends('mainLayout.main')
@section('pageTitle'  )
@lang('strings.DISPLAY_NOTE')
@endsection
@section('customCSS')

@endsection
@section('content')
 

        <!-- main content  -->
            
            @auth

               @include('includes.sideBar')
            
            @endauth
    
                
            <div class="main-content  @guest display @endguest ">

           
            <!-- end information section  -->
            <!-- notes section  -->
             
    
                    <div class="section container">
                        <div class=" list-box">
                        <div class="items-holder  w-100">

                                <div class="list-item w-100">
                                    <div class="cover" >
                                        <img src="{{asset($note->image->url)}} " alt="{{$note->content}}" >
                                    </div>
                                    <div class="head">
                                        <span class="type bg-{{$note->type}}"  >@lang('strings.TYPES.'.$note->type) </span>
                                        <small class="date">{{$note->created_at->format('Y-m-d')}}</small>
                                    </div>
                                    <div class="body">
                                        <p>{{$note->content}}</p>
                                    </div>
                                </div>
                            </div>
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



