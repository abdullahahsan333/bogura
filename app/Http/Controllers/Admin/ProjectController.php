<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'project';
        $this->data['employeeList'] = Employee::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->data['results'] = Project::getAllProject($request);

        return view('admin.project.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            flash()->error('Please fill all required fields correctly.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new Project;
        
        $data->name       = $request->name;
        $data->description= $request->description;
        $data->status     = $request->status;
        $data->emp_id     = $request->emp_id;

        $file             = $request->file('file');
        if (!empty($file)) {
            $data->file  = uploadFile($file, 'uploads/project');
        }

        $data->save();

        flash()->success('Project saved successfully.');
        return redirect()->route('admin.projects');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->data['info'] = Project::getProject($id);

        return view('admin.project.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Project::find($request->id);
            
        $data->name       = $request->name;
        $data->description= $request->description;
        $data->status     = $request->status;
        $data->emp_id     = $request->emp_id;

        $file = $request->file('file');
        if (!empty($file)) {
            if (file_exists($data->file)) unlink($data->file);
            $data->file = uploadFile($file, 'uploads/project');
        }

        $data->save();

        flash()->success('Project Update successfully.');
        return redirect()->route('admin.projects');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Project::find($id);

        $data->delete();

        flash()->success('Project delete successful.', 'Delete');

        return redirect()->back();
    }


        // update Status
        public function statusUpdate(Request $request)
        {
            Project::where('id', $request->id)->update(['status' => $request->status]);
            flash()->success('Project Status successful.');
            echo 'success';
        }
    
}
