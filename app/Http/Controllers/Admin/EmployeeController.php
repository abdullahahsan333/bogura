<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->data['url'] = "admin";
        $this->data['activeMenu'] = 'employee';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->data['results'] = Employee::getAllEmployee($request);

        return view('admin.employee.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employee.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            flash()->error('Please fill all required fields correctly.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new Employee;
        
        $data->name       = $request->name;
        $data->email      = $request->email;
        $data->mobile     = $request->mobile;
        $data->address    = $request->address;

        $avatar = $request->file('avatar');
        if (!empty($avatar)) {
            $data->avatar  = uploadImage($avatar, 'uploads/employee');
        }

        $data->save();

        flash()->success('Employee saved successfully.');
        return redirect()->route('admin.employees');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->data['info'] = Employee::getEmployee($id);

        return view('admin.employee.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Employee::find($request->id);
            
        $data->name       = $request->name;
        $data->mobile     = $request->mobile;
        $data->address    = $request->address;

        $avatar = $request->file('avatar');
        if (!empty($avatar)) {
            if (file_exists($data->avatar)) unlink($data->avatar);
            $data->avatar = uploadImage($avatar, 'uploads/employee');
        }

        $data->save();

        flash()->success('Employee Update successfully.');
        return redirect()->route('admin.employees');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Employee::find($id);

        $data->delete();

        flash()->success('Employee delete successful.', 'Delete');

        return redirect()->back();
    }
}
