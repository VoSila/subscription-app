<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use App\Repository\SubscriptionRepository;
use App\Services\StripeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Stripe\Exception\ApiErrorException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $usersRepository;

    /**
     * @var SubscriptionRepository
     */
    private SubscriptionRepository $subscriptionRepository;

    /**
     * @var StripeService
     */
    private StripeService $stripeService;


    /**
     * @param UserRepository $usersRepository
     * @param SubscriptionRepository $subscriptionsRepository
     */

    public function __construct(UserRepository         $usersRepository,
                                SubscriptionRepository $subscriptionsRepository,
                                StripeService          $stripeService
    )
    {
        $this->usersRepository = $usersRepository;
        $this->subscriptionRepository = $subscriptionsRepository;
        $this->stripeService = $stripeService;
    }

    /**
     * @return View
     */

    public function index(): View
    {
        return view('index');
    }

    /**
     * @return array|false|Application|Factory|View|mixed
     * @throws ApiErrorException
     */

    public function profile(): mixed
    {
        $user = $this->usersRepository->findById(auth()->id());
        $subscription = $this->subscriptionRepository->findById(auth()->id());
        $card = $this->stripeService->getCard($user);

        return view('profile', ['subscriptions' => $subscription, 'user' => $user, 'card' => $card]);
    }


}
