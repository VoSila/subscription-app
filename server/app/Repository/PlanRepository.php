<?php

namespace App\Repository;

use App\Models\Plan as PlanModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PlanRepository
{
    /**
     *  Get information about the plan
     *
     * @return Collection|Builder[]
     */
    public function getPlans(): array|Collection
    {
        return PlanModel::query()
            ->get();
    }

    /**
     *  Get plan by id
     *
     * @return Builder[]|Collection
     */
    public function getPlansById($id)
    {
        return PlanModel::find($id);
    }

}
