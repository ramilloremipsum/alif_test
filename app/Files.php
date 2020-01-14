<?php

namespace App;


use App\Http\Requests\CreateFileInFolderRequest;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class Files extends Model
{
    protected $table = 'files';

    protected $fillable = ['title', 'description', 'folder_id'];

    public static function createFile(FormRequest $request)
    {
        $filename = $request->file->getClientOriginalName();
        $uploadedFile = $request->file('file');
        if (self::fileAlreadyExists($filename)) {
            throw new \DomainException('Файл с таким именем уже существует');
        }
        $model = new self();
        $model->title = $filename;
        $model->folder_id = $request->folder_id;
        $model->description = $request->description;
        Storage::disk('public')->putFileAs(
            'files',
            $uploadedFile,
            $filename
        );
        if($model->save()){
            return $model;
        }
    }

    public function folder()
    {
        return $this->belongsTo('App\Folders', 'folder_id', 'id');
    }

    public static function fileAlreadyExists($filename)
    {
        return self::query()->where('title', '=', $filename)->first();
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

    public function deleteFile()
    {
        Storage::disk('public')->delete('files/' . $this->title);
        $this->delete();
    }
}
