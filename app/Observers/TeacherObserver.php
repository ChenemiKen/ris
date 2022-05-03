<?php

namespace App\Observers;

use App\Models\Teacher;

class TeacherObserver
{
    public function retrieved(Teacher $teacher)
    {
        foreach($teacher->user->toArray() as $key => $value){
            $teacher->setAttribute($key, $value);
        }
    }
}
