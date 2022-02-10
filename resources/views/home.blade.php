@extends('mainLayout.main')
@section('pageTitle'  )
@lang('strings.HOME')
@endsection
@section('customCSS')

@endsection
@section('content')
        @include('includes.sideBar')


        <!-- main content  -->
        <div class="main-content">
            <!-- information section  -->
            <div class="section container">
                 
                     
                         
                    <!-- card box  -->
                    <div class="col-sm-6 col-md-4  ">
                        <div class="card-box-holder">
                            <div class="card-box bg-normal">
                                <span class="icon "><i class="far fa-clipboard"></i></span>
                                <span class="title">
                                                                
                                    @if ( ! empty($notes->groupBy('type')['normal']) )
                                        {{count($notes->groupBy('type')['normal'])}}
                                   @else
                                      0
                                   @endif    
                                    </span>
                                <span class="content"><a href="#">@lang('strings.TYPES.normal')</a></span>
                            </div>
                        </div>
                    </div>
                    <!-- end card box -->
                    
                    <!-- card box  -->
                    <div class="col-sm-6 col-md-4  ">
                        <div class="card-box-holder">
                            <div class="card-box bg-urgent">
                                <span class="icon "><i class="far fa-clipboard"></i></span>
                                <span class="title">
                                
                                @if ( ! empty($notes->groupBy('type')['urgent']) )
                                     {{count($notes->groupBy('type')['urgent'])}}
                                @else
                                   0
                                @endif
                                </span>
                                <span class="content"><a href="#">@lang('strings.TYPES.urgent')</a></span>
                            </div>
                        </div>
                    </div>
                    <!-- end card box -->
                    
                    <!-- card box  -->
                    <div class="col-sm-6 col-md-4  ">
                        <div class="card-box-holder">
                            <div class="card-box bg-on-date">
                                <span class="icon "><i class="far fa-clipboard"></i></span>
                                <span class="title">
                                                                
                                @if ( ! empty($notes->groupBy('type')['on-date']) )
                                    {{count($notes->groupBy('type')['on-date'])}}
                               @else
                                  0
                               @endif    
                                </span>
                                <span class="content"><a href="#">@lang('strings.TYPES.on-date')</a></span>
                            </div>
                        </div>
                    </div>
                    <!-- end card box -->
                    
                     

                
            </div>
            <!-- alert messege -->
            @include('includes.alertMsg')
            <!-- end alert messege  -->
            <!-- end information section  -->
            <!-- notes section  -->
            <div class="section container">
                <div class="notes list-box">
                    <div id="notes" class="header">@lang('strings.NOTES') </div>
                    <div class="items-holder">
                        
                        @if (   count($pNotes)>0)
                            @foreach ($pNotes as $note)
                            <div class="list-item">
                                <div class="cover" >
                                    <div class="btns-holder">

                                        <a href="{{route('deleteNote',['id'=>$note->id])}}"><span class="icon "  ><i class="fas fa-trash"></i></span></a>
                                        <a href="{{route('editNote',['id'=>$note->id])}}"><span class="icon "  ><i class="fas fa-edit"></i></span></a>
                                        <a href="{{route('shareNote',['shareToken'=>$note->shareToken])}}"><span class="icon "  ><i class="fas fa-eye"></i></span></a>
                                        <a  class="js-copy-share-link" data-shareLink="{{route('shareNote',['shareToken'=>$note->shareToken])}}">
                                            <span class="icon "  ><i class="fas fa-share-alt"></i></span>
                                            <span class="tooltip-elem bg-success">@lang('strings.LINK_SHARED')</span>
                                        </a>
                                    </div>
                                    <img src="{{asset($note->image->url)}}" alt="{{$note->content}}" >
                                </div>
                                <div class="head">
                                    <span class="type bg-{{$note->type}}"  >@lang('strings.TYPES.'.$note->type) </span>
                                    <small class="date">{{$note->created_at->format('Y-m-d')}}</small>
                                </div>
                                <div class="body">
                                    <p>{{$note->content}}</p>
                                </div>
                            </div>
                                
                            @endforeach
                            
                        </div>
                        <div class="section">
                         
                            <div class="pagination-links">
                                @if(! $pNotes->onFirstPage())  <a  href="{{$pNotes->previousPageUrl()}}"><i class="far fa-arrow-alt-circle-right"></i></a>@endif
                                @if($pNotes->hasMorePages())<a href="{{$pNotes->nextPageUrl()}}"><i class="far fa-arrow-alt-circle-left"></i></a>@endif
                            </div>

                        </div>
                        @else
                            <div> @lang('strings.NO_NOTES_YET')</div>
                        </div>
                        @endif
         
                </div>
            </div>
            <!-- end notes section  -->
            @include('includes.copyRight')
       
        </div>
        <!-- end main content  -->


@endsection

@section('customJS')
    
    
@endsection



