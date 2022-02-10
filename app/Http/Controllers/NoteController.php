<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Note;
use App\Models\Image;
class NoteController extends Controller
{
    


     
    public function read(){
        $pNotes= Auth::user()->notes()->orderBy('created_at','DESC')->paginate(8)->fragment('notes'); //get all notes of login user 
        $notes= Auth::user()->notes ;
        
        return view('home',compact( //display home page 
            'notes',
            'pNotes',
        ) );
    }

    public function create(){
         
        return view('addNote');//dispaly add note screen 
    }
    public function save(Request $request){
       
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
            
        ])->validate();
        $note=new Note();//create new note object 
        $note->type=$request->type;
        $note->content=$request->content;
        $note->user()->associate(Auth::user()); // associate the current login user (owner of note )
        $note->shareToken=Str::random(8).Carbon::now()->format('Uu');// generate a share link  (i used random string and a current datatime to generate a unique link 
                                                                    //,it  helpes to avoid the appelite to gess the note link and my any one can access to it without have link from user
                                                                    //if link like www.exemple.com/note/458   any one can chenge just 458 and access to other note that he don't have the link to it 
        $note->save();
        
        if($request->hasFile('image')){ // check if image uploaded
            $note->image()->create([ 'url'=>'storage/'.$request->image->store('notes','public') ]);// save image in hard and save url in database
            $note->save();
        }
       
        
        return redirect()->back()->with('success',__('strings.NOTE_ADDED')); //return with success messege
    }


    public function edit($id){
        $note=Auth::user()->notes->find($id);//check if user is the owner of the note that he need  to edit it
        if(empty($note)) //if not the owner return error messeg
            return redirect()->route('home')->withErrors(['edit'=>__('strings.NOTE_NOT_EXISTE')]);
        
        return view('editNote',compact([ //display the edit screen 
            'note',
        ]));
    }
    public function update(Request $request,$id){
        $note=Auth::user()->notes->find($request->id);//check if user is the owner of the note that he need  to update it
        if(empty($note)) //if not the owner return error messeg
           return redirect()->route('home')->withErrors(['edit'=>__('strings.NOTE_NOT_EXISTE')]);

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
            
        ])->validate();
         
        $note->type=$request->type;
        $note->content=$request->content;
        $note->user()->associate(Auth::user()); // associate the current login user (owner of note )
        $note->save();
        
        if($request->hasFile('image')){ // check if image uploaded
            if($note->image->id !=-1 ){//if note  have image before delete old one from storage hard and replace it with new one  
                 
                Storage::disk("public")->delete(str_replace('storage/' ,'',$note->image->url));
                $note->image->url= 'storage/'.$request->image->store('notes','public') ;
                $note->image->save();

            }else{// if note don't have image before create new one
                
                $note->image()->create([ 'url'=>'storage/'.$request->image->store('notes','public') ]);// save image in hard and save url in database
            }

            $note->save();
        }
       
        
        return redirect()->back()->with('success',__('strings.NOTE_UPDATED')); //return with success messege
      
    }
    public function delete(Request $request,$id){
        $note=Auth::user()->notes->find($id) ;
        if(empty($note))
            return redirect()->route('home')->withErrors(['delete'=>__('strings.NOTE_NOT_EXISTE')]); 
        $note->delete();//in soft delete we don't delete image from hard in case we undelete note in future
        return redirect()->route('home')->with('success',__('strings.NOTE_DELETED')); 
    }
    public function share($shareToken){
        $note=Note::where('shareToken', $shareToken)->firstOrFail();
        
        return view('displayNote',compact(
            'note',
        )) ;
    }
}
