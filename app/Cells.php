<?php

namespace App;

use App\Http\Requests\CreateFolderInCellRequest;
use Illuminate\Database\Eloquent\Model;

class Cells extends Model
{
    protected $table = 'cells';
    protected $fillable = ['title', 'description'];

    public function createFolder(CreateFolderInCellRequest $request)
    {
        $request->request->add([
            'cell_id' => $this->id
        ]);
        Folders::create($request->all());
    }

    public function delete()
    {
//        if ($this->hasFolders()) {
//            throw new CellHasFoldersException();
//        }
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    public function hasFolders()
    {
        return count($this->folders) > 0;
    }

    public function box()
    {
        return $this->belongsTo('App\Boxes', 'box_id', 'id');
    }

    public function folders()
    {
        return $this->hasMany('App\Folders', 'cell_id', 'id');
    }

}
