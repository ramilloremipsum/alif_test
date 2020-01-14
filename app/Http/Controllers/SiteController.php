<?php

namespace App\Http\Controllers;

use App\Documents;
use App\Files;
use App\Folders;
use App\Workplaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        $workplace = Workplaces::query()->first();
        return view('welcome', [
            'workplace' => $workplace
        ]);
    }

    public function search(Request $request)
    {
        $resultDocuments = false;
        $resultFolders = false;
        $q = $request->get('q');
        if (!empty($q)) {
            $resultDocuments = Files::query()
                ->select(DB::raw(
                'files.*,
                    IF(`files`.`title` like  \'' . $q . '\', 100, 0)
                    + IF(`files`.`title` like  \'' . $q . '%\', 90, 0)
                    + IF(`files`.`title` like  \'% ' . $q . '%\', 80, 0)
                    + IF(`files`.`title` like  \'%' . $q . '\', 70, 0)
                     AS `relevance`'
            ))
                ->where('title', 'like', '%' . $q . '%')
                ->orderBy(DB::raw('`relevance`'), 'DESC')
                ->with(['folder.cell.box.workplace'])
                ->get();
            $resultFolders = Folders::query()
                ->select(DB::raw(
                'folders.*,
                    IF(`folders`.`title` like  \'' . $q . '\', 100, 0)
                    + IF(`folders`.`title` like  \'' . $q . '%\', 90, 0)
                    + IF(`folders`.`title` like  \'% ' . $q . '%\', 80, 0)
                    + IF(`folders`.`title` like  \'%' . $q . '\', 70, 0)
                     AS `relevance`'
            ))
                ->where('title', 'like', '%' . $q . '%')
                ->orderBy(DB::raw('`relevance`'),
                'DESC')
                ->with(['cell.box.workplace'])
                ->get();
        }
        return view('search', [
            'resultDocuments' => $resultDocuments,
            'resultFolders' => $resultFolders,
            'q' => $q
        ]);
    }
}
