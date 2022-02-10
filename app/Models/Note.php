<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'notes';

    public function image()
    {
        return $this->hasOne(Image::class , 'note_id', 'id')->withDefault([
            'url' => 'img/defaultNoteImage.jpg',
            'id'=> -1,
        ]);;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
