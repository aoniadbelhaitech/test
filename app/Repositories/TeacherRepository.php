<?php namespace App\Repositories;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeacherRepository extends BaseRepository
{
    public function create(array $data)
    {
        $student['user_id'] = User::insertGetId($data);
        $this->model->user_id = $student['user_id'];
        return ($this->model->save()) ? $this->model : null;
    }

    public function show($id)
    {
        return $this->model->with('user')->with('period')->where('id', $id)->get();
    }

    public function update(array $data, $id)
    {
        return $this->model->findOrFail($id)->user()->update(['name' => $data['name']]);
    }
    public function getAllStudents($id)
    {
        return DB::select(DB::raw("select * from users where id in (
select student_id from period_student where period_id in(SELECT id FROM periods where teacher_id=:id));"), array(
            'id' => $id,
        ));

    }
}
