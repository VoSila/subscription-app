<?php

namespace App\Services;

use App\Repository\UserRepository;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\StripeObject;

class StripeService
{


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
