<?php namespace App\Repositories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->model->create($data);
        return ['user' => $user, 'access_token' => $user->createToken('authToken')->accessToken];
    }
}
