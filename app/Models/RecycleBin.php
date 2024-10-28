<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RecycleBin extends Model
{
    use HasFactory;
    
    static function getDeleteEmployee() {
        return Employee::onlyTrashed()->with('projects')->get();
    }
    static function getDeleteProject() {
        return Project::onlyTrashed()->with('employee')->get();
    }
}
