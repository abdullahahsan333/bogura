<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Project;
use App\Models\RecycleBin;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'recycle-bin';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->data['employeeList'] = RecycleBin::getDeleteEmployee();
        $this->data['projectList'] = RecycleBin::getDeleteProject();


        return view('admin.recycle-bin.index', $this->data);
    }


    public function employeeRestore(string $id) {
        $employee = Employee::withTrashed()->find($id);

        if ($employee) {
            $employee->restore();
            flash()->success('Employee Restore successful.');
            return redirect()->back();
        } else {
            flash()->success('Employee can not Restore!');
            return redirect()->back();
        }
    }

    public function projectRestore(string $id) {
        $project = Project::withTrashed()->find($id);

        if ($project) {
            $project->restore();
            flash()->success('Project Restore successful.');
            return redirect()->back();
        } else {
            flash()->success('Project can not Restore!');
            return redirect()->back();
        }
    }

}
