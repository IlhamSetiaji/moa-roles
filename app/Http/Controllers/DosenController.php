<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\MenteeTask;
use App\Models\MasterClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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

    public function showTasks($masterClassID)
    {
        $tasks=Task::where('master_class_id',$masterClassID)->get();
        return view('dosen.tasks',compact('tasks','masterClassID'));
    }

    public function storeTask(Request $request, $masterClassID)
    {
        $task=Task::create([
            'master_class_id' => $masterClassID,
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $users=User::role('mahasiswa')->get();
        foreach($users as $user)
        {
            MenteeTask::create([
                'user_id'=>$user->id,
                'task_id'=>$task->id,
                'status'=>'UNFINISHED',
            ]);
        }
        return redirect()->back()->with('status','Tugas berhasil ditambahkan');
    }

    public function updateTask(Request $request, $taskID)
    {
        $task=Task::find($taskID);
        $task->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->back()->with('status','Tugas berhasil diupdate');
    }

    public function deleteTask($taskID)
    {
        Task::destroy($taskID);
        return redirect()->back()->with('status','Tugas berhasil dihapus');
    }

    public function detailTask($taskID)
    {
        $menteeTasks=MenteeTask::where('task_id',$taskID)->get();
        return view('dosen.detail_task', compact('menteeTasks'));
    }

    public function showFiles($menteeTaskID, $userID)
    {
        $menteeTask=MenteeTask::where('user_id',$userID)->where('task_id',$userID)->first();
        $files=$menteeTask->mentee_task_files()->get();
        return view('dosen.show_files', compact('files'));
    }

    public function download($fileName, $userID)
    {
        $user=User::find($userID);
        $file=$user->mentee_task_files()->where('file_name',$fileName)->first();
        $file_path = public_path($user->name.'/data_tugas/'.$fileName);
        return response()->download($file_path);
    }
}
