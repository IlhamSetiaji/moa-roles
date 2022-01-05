<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\MasterClass;
use App\Models\MenteeTask;
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
        if($masterClass->users()->where('user_id', $user->id)->exists())
        {
            return redirect('mahasiswa/classes/')->with('status','anda sudah masuk di kelas ini');
        }
        $masterClass->users()->attach($user->id);
        return redirect('mahasiswa/classes/');
    }

    public function detailClass($masterClassID)
    {
        $user=request()->user();
        $masterClass=MasterClass::find($masterClassID);
        if($masterClass->users()->where('user_id',$user->id)->exists())
        {
            $tasks=Task::where('master_class_id',$masterClassID)->get();
            return view('mahasiswa.detail_class', compact('tasks','masterClassID'));
        }
        return redirect('mahasiswa/classes/')->with('status','Anda belum masuk ke kelas ini');
    }

    public function uploadTask(Request $request, $menteeTaskID)
    {
        $user=request()->user();
        if($request->hasFile('files'))
        {
            foreach($request->file('files') as $file)
            {
                $nama_file = time()."_".$file->getClientOriginalName();
                $format_file = $file->getClientOriginalExtension();
                $file->move(public_path($user->name.'/data_tugas'), $nama_file);
                $user->mentee_task_files()->attach($menteeTaskID,[
                    'file_name'=>$nama_file,
                ]);
            }
        }
        $menteeTask=MenteeTask::find($menteeTaskID);
        $menteeTask->update([
            'status'=>'FINISHED',
        ]);
        return redirect()->back()->with('status','File tugas berhasil diupload');
    }

    public function detailTask($taskID)
    {
        $user=request()->user();
        $menteeTasks=MenteeTask::where('task_id',$taskID)->where('user_id',$user->id)->first();
        return view('mahasiswa.detail_task',compact('menteeTasks'));
    }
}
