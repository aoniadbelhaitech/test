<?php namespace App\Repositories;


class PeriodRepository extends BaseRepository
{
    public function show($id)
    {
        return $this->model->with('teacher')->with('students')->find($id);
    }

    public function update(array $data, $id)
    {
        $model = $this->model->findOrFail($id);
        if (isset($data['student_id'])) {
            $model->students()->attach($data['student_id']);
        }
        $model->update($data);
        return $model;
    }

    public function create(array $data)
    {
        $post['name'] = $data['name'];
        $post['teacher_id'] = $data['teacher_id'];
        $this->model->name = $post['name'];
        $this->model->teacher_id = $post['teacher_id'];
        $this->model->save();
        if (isset($data['student_id'])) {
            $this->model->students()->attach($data['student_id']);
            //return periodStudent::create(['student_id' => $data['student_id'], 'period_id' => $this->model->id]);
        }
        return $this->model;

    }
}
