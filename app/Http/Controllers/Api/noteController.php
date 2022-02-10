<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Note;
use App\Models\Image;
class noteController extends Controller
{
    public function notes(){
         
        $notes= Auth::guard('api')->user()->notes ;//get all notes of login user 
        return response()->json([
            'status'=>True,
            'msg'=>'',
            'errorCode'=>null,
            'data'=>$notes,
        ]);
        
    }


    public function add(Request $request){
       
        $imageSize=2048;// max image size that user can uplaod in note
        $validator=Validator::make($request->all(), [ // validate user inputs
            
            'image' =>'nullable|mimes:jpeg,png,jpg|max:'.$imageSize, // image can be null(optional ),accepted image types are jpeg png jpg , max size is 2048 kb  
            'type' => ['required',Rule::in(['normal', 'urgent','on-date'])],//type required ,   shoud be one of normal ,urgent or on-date 
            'content' => 'required',//content required 
          
        ],
        [ // messeges in case the validation fail
            'image.mimes'=>__('strings.IMAGE_EXTENSION' ),
            'image.max'=>__('strings.IMAGE_MAX_SIZE',['size'=>$imageSize/1024]),
            'type.required'=>__('strings.TYPE_REQUIRED'),
            'type.in'=>__('strings.TYPE_NOT_EXISTE'),
            'content.required'=>__('strings.CONTENT_REQUIRED'),
            
        ]) ;


        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'msg'=> $validator->errors(), 
                'errorCode'=>'E2',
                'data'=>null,
            ]);
        }
        $note=new Note();//create new note object 
        $note->type=$request->type;
        $note->content=$request->content;
        $note->user()->associate(Auth::guard('api')->user()); // associate the current login user (owner of note )
        $note->shareToken=Str::random(8).Carbon::now()->format('Uu');// generate a share link  (i used random string and a current datatime to generate a unique link 
                                                                    //,it  helpes to avoid the appelite to gess the note link and my any one can access to it without have link from user
                                                                    //if link like www.exemple.com/note/458   any one can chenge just 458 and access to other note that he don't have the link to it 
        
         
        
        if($request->hasFile('image')){ // check if image uploaded
            $note->image()->create([ 'url'=>'storage/'.$request->image->store('notes','public') ]);// save image in hard and save url in database
        }
        $note->image;
        $note->save();
       
        return response()->json([
            'status'=>true,
                'msg'=>__('strings.NOTE_ADDED'), 
                'errorCode'=>null,
                'data'=>$note,
        ]);
    }

    public function delete(Request $request){
       
        $note=Auth::guard('api')->user()->notes->find($request->id) ;
        if(empty($note))
            return response()->json([
                'status'=>false,
                'msg'=>__('strings.NOTE_NOT_EXISTE'), 
                'errorCode'=>'E1',
                'data'=>null,
            ]);
        $note->delete();//in soft delete we don't delete image from hard in case we undelete note in future
        
        return response()->json([
            'status'=>true,
            'msg'=>__('strings.NOTE_DELETED'), 
            'errorCode'=>null,
            'data'=>null,
        ]);
    }

    public function edit(Request $request){
        $note=Auth::guard('api')->user()->notes->find($request->id)->first(); //check if user is the owner of the note that he need  to update it
         
        if(empty($note)) //if not the owner return error messeg
            
            return response()->json([
                'status'=>false,
                'msg'=>__('strings.NOTE_NOT_EXISTE'), 
                'errorCode'=>'E1',
                'data'=>null,
            ]);
        $imageSize=2048;// max image size that user can uplaod in note
        $validator=Validator::make($request->all(), [ // validate user inputs
            'image' =>'nullable|mimes:jpeg,png,jpg|max:'.$imageSize, // image can be null(optional ),accepted image types are jpeg png jpg , max size is 2048 kb  
            'type' => ['required',Rule::in(['normal', 'urgent','on-date'])],//type required ,   shoud be one of normal ,urgent or on-date 
            'content' => 'required',//content required 
          
        ],
        [ // messeges in case the validation fail
            'image.mimes'=>__('strings.IMAGE_EXTENSION' ),
            'image.max'=>__('strings.IMAGE_MAX_SIZE',['size'=>$imageSize/1024]),
            'type.required'=>__('strings.TYPE_REQUIRED'),
            'type.in'=>__('strings.TYPE_NOT_EXISTE'),
            'content.required'=>__('strings.CONTENT_REQUIRED'),
            
        ]) ;
        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'msg'=> $validator->errors(), 
                'errorCode'=>'E2',
                'data'=>null,
            ]);
        }
        $note->type=$request->type;
        $note->content=$request->content;
        $note->user()->associate(Auth::guard('api')->user()); // associate the current login user (owner of note )
        
        
        if($request->hasFile('image')){ // check if image uploaded
            if($note->image->id !=-1 ){//if note  have image before delete old one from storage hard and replace it with new one  
                 
                Storage::disk("public")->delete(str_replace('storage/' ,'',$note->image->url));
                $note->image->url= 'storage/'.$request->image->store('notes','public') ;
                

            }else{// if note don't have image before create new one
                
                $note->image()->create([ 'url'=>'storage/'.$request->image->store('notes','public') ]);// save image in hard and save url in database
            }

            
        }
        $note->image;
        $note->save();
       
        
        return response()->json([
            'status'=>true,
            'msg'=> __('strings.NOTE_UPDATED'), 
            'errorCode'=>null,
            'data'=>$note ,
        ]);
    }
}
