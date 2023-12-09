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
    public function startPage(Request $request)
    {

        $Tasks = Tasks::orderBy('priority','asc')->get();
        return Inertia::render('Welcome', [
            'tasks' => $Tasks,
        ]);
    }
}
