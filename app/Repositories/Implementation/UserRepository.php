<?php
namespace App\Repositories\Implementation;

use App\Repositories\Interfaces\IUserRepository;

class UserRepository extends GenericRepository implements IUserRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getAllUser()
    {
      //  return $this->model->select('product_name')->take(5)->get();
      return $this->model->get();
    }
}
