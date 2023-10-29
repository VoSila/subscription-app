<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Cashier\Subscription;


class SubscriptionRepository
{
    /**
     *  * Find subscription model by id
     *
     * @param int $id
     *
     * @return Collection|Builder[]
     */
    public function findById(int $id): array|Collection
    {
        return Subscription::query()
            ->select('subscriptions.id','plans.name','subscriptions.stripe_status','subscriptions.ends_at')
            ->where('user_id', $id)
            ->join('plans', 'plans.id', '=', 'subscriptions.name')
            ->get();
    }

    /**
     * Find active subscription
     *
     * @param int $userId
     * @param string $subscriptionId
     * @return mixed
     */
    public function subscriptions(int $userId, string $subscriptionId): mixed
    {
        return Subscription::where('user_id', $userId)
            ->where('id', $subscriptionId)
            ->where('stripe_status', 'active')
            ->first();
    }

}
