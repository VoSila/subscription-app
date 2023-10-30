<?php

namespace App\Http\Controllers;

use App\Repository\PlanRepository;
use App\Services\SubscriptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{

    /**
     * @var PlanRepository
     */
    private PlanRepository $plansRepository;

    /**
     * @var SubscriptionService
     */
    private SubscriptionService $subscriptionService;

    /**
     * @param PlanRepository $plansRepository
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(PlanRepository      $plansRepository,
                                SubscriptionService $subscriptionService)
    {
        $this->plansRepository = $plansRepository;
        $this->subscriptionService = $subscriptionService;
    }

    /**
     *
     * @return response()
     */
    public function index()
    {
        $plans = $this->plansRepository->getPlans();
        return view("account/plans", compact("plans"));
    }

    /**
     *
     * @return response()
     */
    public function show(Plan $plan, Request $request): Response
    {
        $intent = auth()
            ->user()
            ->createSetupIntent();
        return view("account/subscription", compact("plan", "intent"));
    }

    /**
     * Purchasing a subscription
     *
     * @return RedirectResponse()
     */
    public function subscription(Request $request): RedirectResponse
    {
        $plan = $this->plansRepository->getPlansById($request->plan);

        $subscription = $request->user()
            ->newSubscription($request->plan, $plan->stripe_plan)
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

    public function cancel(Request $request): RedirectResponse
    {
        $cancel = $this->subscriptionService->cancelSubscription($request);

        if ($cancel) {
            return redirect()
                ->route('profile')
                ->with('success', 'Подписка отменена!');

        } else {
            return redirect()
                ->route('profile')
                ->with('error', 'Ошибка!');
        }
    }

    /**
     * Resume subscription payment
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function resume(Request $request): RedirectResponse
    {
        $resume = $this->subscriptionService->resumeSubscription($request);

        if ($resume) {
            return redirect()
                ->route('profile')
                ->with('success', 'Подписка возобновлена!');

        } else {
            return redirect()
                ->route('profile')
                ->with('error', 'Ошибка!');
        }
    }
}
