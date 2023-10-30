<?php

namespace App\Services;

use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\StripeObject;

class ProfileService
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
     * @param UserRepository $usersRepository
     * @param SubscriptionRepository $subscriptionsRepository
     */

    public function __construct(UserRepository         $usersRepository,
                                SubscriptionRepository $subscriptionsRepository,
    )
    {
        $this->usersRepository = $usersRepository;
        $this->subscriptionRepository = $subscriptionsRepository;
    }

    /**
     * @throws ApiErrorException
     */
    public function profileList(): array
    {
        $user = $this->usersRepository->findById(auth()->id());
        $subscription = $this->subscriptionRepository->findById(auth()->id());
        $card = $this->getCard($user);
        return ['subscriptions' => $subscription, 'user' => $user, 'card' => $card];
    }

    /**
     * Get a user card
     *
     * @param $user
     * @return StripeObject|null
     * @throws ApiErrorException
     */
    public function getCard($user): StripeObject|null
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customerId = $user->stripe_id;
        if ($customerId) {
            $customer = Customer::retrieve($customerId);
            $defaultPaymentMethodId = $customer->invoice_settings->default_payment_method;
            $paymentMethod = PaymentMethod::retrieve($defaultPaymentMethodId);

            $card = $paymentMethod->card;
        } else {
            $card = null;
        }
        return $card;
    }
}
