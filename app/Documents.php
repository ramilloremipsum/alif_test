<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';

    protected $fillable = ['title', 'data', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo('App\Folders', 'folder_id', 'id');
    }

}
