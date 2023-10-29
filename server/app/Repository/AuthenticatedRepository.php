<?php

namespace App\Repository;

use App\Models\User;


class AuthenticatedRepository
{
 public function getUserName($request){
     return User::where('id', $request->id)->first();
 }
}
