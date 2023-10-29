<?php

namespace App\Http\Controllers;

use App\Repository\PlanRepository;
use App\Repository\SubscriptionRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{

    /**
     * @var SubscriptionRepository
     */
    private SubscriptionRepository $subscriptionRepository;

    /**
     * @var PlanRepository
     */
    private PlanRepository $plansRepository;

    /**
     * @param SubscriptionRepository $subscriptionsRepository
     * @param PlanRepository $plansRepository
     */
    public function __construct(SubscriptionRepository $subscriptionsRepository,
                                PlanRepository         $plansRepository)
    {
        $this->subscriptionRepository = $subscriptionsRepository;
        $this->plansRepository = $plansRepository;
    }

    /**
     *
     * @return response()
     */
    public function index()
    {

        $plans = $this->plansRepository->getPlans();

        return view("plans", compact("plans"));
    }

    /**
     *
     * @return response()
     */
    public function show(Plan $plan, Request $request)
    {

        $intent = auth()->user()->createSetupIntent();

        return view("subscription", compact("plan", "intent"));
    }

    /**
     * Purchasing a subscription
     *
     * @return RedirectResponse()
     */
    public function subscription(Request $request): RedirectResponse
    {
        $plan = $this->plansRepository->getPlansById($request->plan);

        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
            ->create($request->token);

        return redirect()
            ->route('profile')
            ->with('success', 'Подписка приобретена успешно!');
    }

    /**
     * Cancel subscription payment
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function cancelSubscription(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $userId = $user->id;
        $plan = $request->plan;

        $subscription = $this->subscriptionRepository->subscriptions($userId, $plan);

        if ($subscription) {
            $subscription->cancel();

            return redirect()
                ->route('profile')
                ->with('success', 'Подписка отменена');
        } else {

            return redirect()
                ->route('admin.reviews')
                ->with('error', 'Подписка отсутствует!');
        }
    }

    /**
     * Resume subscription payment
     *
     * @param Request $request
     *
     * @return RedirectResponse|void
     */

    public function resumeSubscription(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $plan = $request->plan;

        $subscription = $this->subscriptionRepository->subscriptions($userId, $plan);

        if ($subscription) {
            $subscription->resume();

            return redirect()
                ->route('profile')
                ->with('success', 'Подписка возобновлена');
        }
    }
}

