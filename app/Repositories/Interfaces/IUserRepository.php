<?php
namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\IGenericRepository;

interface IUserRepository extends IGenericRepository
{
    public function getAllUser();
}

