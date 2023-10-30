<?php

namespace App\Repository;

use App\Models\User;


class AuthenticatedRepository
{

    /**
     * @param $request
     * @return mixed
     */
 public function getUserName($request): mixed
 {
     return User::where('id', $request->id)->first();
 }
}
