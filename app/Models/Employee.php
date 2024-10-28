<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;


class Employee extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    static function getAllEmployee(Request $request) {
        $where = [];
        if(!empty($request->status)) {
            $where['status'] = $request->status;
        }
        return Employee::with('projects')->where($where)->orderBy('id', 'DESC')->get();
    }

    static function getEmployee($id) {
        return Employee::find($id);
    }
}
