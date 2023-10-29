<?php

namespace App\Repository;

use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class UserRepository
{
    /**
     *  * Find user model by id
     *
     * @param int $id
     *
     * @return Model|Builder|null
     */
    public function findById(int $id): Model|Builder|null
    {
        return UserModel::query()
            ->where(UserModel::ID, '=', $id)
            ->first();
    }

}
