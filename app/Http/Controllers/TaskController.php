<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function AddTasks(Request $request)
    {


        $Tasks = new Tasks();
        $Tasks->name = $request->input('name');
        $Tasks->priority = $request->input('priority');
        $Tasks->description = $request->input('description');
        $Tasks->created_at = Carbon::now()->toDateTimeString();
        $Tasks->save();
    }
    public function EditTasks(Request $request)
    {

        $edited = Tasks::where('id', $request->input('id'))->update(['name' => $request->input('name'), 'priority' => $request->input('priority'), 'description' => $request->input('description'), 'edited_at' => Carbon::now()->toDateTimeString()]);
     
    }
    public function startPage(Request $request)
    {

        $Tasks = Tasks::orderBy('priority', 'asc')->get();
        return Inertia::render('Welcome', [
            'tasks' => $Tasks,
        ]);
    }
    public function GetTask($id)
    {
        $Tasks = Tasks::where('id', $id)->get();
        return response()->json($Tasks);
    }
    public function DelTask(Request $req)
    {
        $Tasks = Tasks::where('id', $req->input('id'))->delete();
    }
}
