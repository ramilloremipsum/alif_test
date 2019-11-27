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

    public function getAddressStr()
    {
        if ($this->folder) {
            return 'Место: "' . $this->folder->cell->box->workplace->title . '"" | ' .
                'Шкаф: "' . $this->folder->cell->box->title . '" | ' .
                'Ячейка: "' . $this->folder->cell->title . '" | ' .
                'Папка: "' . $this->folder->title . '"';
        }
        return '';
    }
}
