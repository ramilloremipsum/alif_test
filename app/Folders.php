<?php

namespace App;

use App\Http\Requests\CreateDocumentInFolderRequest;
use Illuminate\Database\Eloquent\Model;

class Folders extends Model
{
    protected $table = 'folders';

    protected $fillable = ['title', 'description', 'cell_id'];

    public function createDocument(CreateDocumentInFolderRequest $request)
    {
        $request->request->add([
            'folder_id' => $this->id
        ]);
        $document = Documents::create($request->all());
        return $document;
    }

    public function hasDocuments()
    {
        return count($this->documents) > 0;
    }

    public function cell()
    {
        return $this->belongsTo('App\Cells', 'cell_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany('App\Documents', 'folder_id', 'id');
    }

    public function getAddressStr()
    {
        return 'Место: "' . $this->cell->box->workplace->title . '"" | ' .
            'Шкаф: "' . $this->cell->box->title . '" | ' .
            'Ячейка: "' . $this->cell->title . '"';
    }

//    public function box()
//    {
//        return $this->hasOneThrough('App\Boxes', 'App\Cells', 'box_id', 'id');
//    }
}
