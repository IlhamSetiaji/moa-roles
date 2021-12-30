<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function showClasses()
    {
        $masterClasses=MasterClass::all();
        return view('mahasiswa.classes', compact('masterClasses'));
    }

    public function joinClass($masterClassID)
    {
        $user=request()->user();
        $masterClass=MasterClass::find($masterClassID);
        $masterClass->users()->attach($user->id);
        return redirect('mahasiswa/classes/');
    }

    public function detailClass($masterClassID)
    {
        $user=request()->user();
        $masterClass=DB::table('master_class_user')->where('user_id', $user->id)
        ->where('master_class_id', $masterClassID)->exists();
        if($masterClass)
        {
            $masterClasses=MasterClass::where('id', $masterClassID)->first();
            return view('mahasiswa.detail_class', compact('masterClasses'));
        }
        return redirect('mahasiswa/classes/')->with('status','Anda belum masuk ke kelas ini');
    }
}
