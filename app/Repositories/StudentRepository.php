<?php namespace App\Repositories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StudentRepository extends BaseRepository
{
    public function create(array $data)
    {
        $student['grade'] = $data['grade'];
        unset($data['grade']);
        $student['user_id'] = User::insertGetId($data);
        $this->model->user_id = $student['user_id'];
        $this->model->grade = $student['grade'];
        return ($this->model->save()) ? $this->model : null;
    }

    public function show($id)
    {

        return $this->model->with('user')->where('id', $id)->get();
    }

    public function update(array $data, $id)
    {
        $model = $this->model->findOrFail($id);
        if (isset($data['name'])) {
            $model->user()->update(['name' => $data['name']]);
        }
        if (!isset($data['grade'])) {
            return $model;
        }
        $model->grade = $data['grade'];
        $model->save();
        return $model;
    }
}
