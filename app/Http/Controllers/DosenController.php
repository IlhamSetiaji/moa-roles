<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function showClasses()
    {
        $masterClasses=MasterClass::all();
        return view('dosen.classes', compact('masterClasses'));
    }

    public function storeClass(Request $request)
    {
        $input=$request->all();
        MasterClass::create($input);
        return redirect('dosen/classes');
    }

    public function editClass(Request $request, $masterClassID)
    {
        $masterClass=MasterClass::find($masterClassID);
        $masterClass->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect('dosen/classes');
    }

    public function deleteClass($masterClassID)
    {
        MasterClass::destroy($masterClassID);
        return redirect('dosen/classes');
    }
}
