<?php

namespace App\Services;

use App\Repository\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;

class SubscriptionService
{
    /**
     * @var SubscriptionRepository
     */
    private SubscriptionRepository $subscriptionRepository;

    /**
     * @param SubscriptionRepository $subscriptionsRepository
     */
    public function __construct(SubscriptionRepository $subscriptionsRepository,)
    {
        $this->subscriptionRepository = $subscriptionsRepository;
    }

    /**
     * @param $request
     * @return bool
     */
    public function cancelSubscription($request): bool
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $plan = $request->plan;

            $subscription = $this->subscriptionRepository->subscriptions($userId, $plan);

            if ($subscription) {
                $subscription->cancel();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $request
     * @return bool
     */
    public function resumeSubscription($request): bool
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $plan = $request->plan;

            $subscription = $this->subscriptionRepository->subscriptions($userId, $plan);

            if ($subscription) {
                $subscription->resume();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
