<?php
namespace App\Repositories\Implementation;

use App\Repositories\Interfaces\IOrderRepository;

class UserRepository extends GenericRepository implements IOrderRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Order::class;
    }

   
}
