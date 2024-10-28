<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    public function employee()
    {
        return $this->belongsTo(Employee::class,'emp_id');
    }

    static function getAllProject(Request $request) {
        $where = [];
        if(!empty($request->status)) {
            $where['status'] = $request->status;
        }
        return Project::with('employee')->where($where)->orderBy('id', 'DESC')->get();
    }

    static function getProject($id) {
        return Project::find($id);
    }
}
