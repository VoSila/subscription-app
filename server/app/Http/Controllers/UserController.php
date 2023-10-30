<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Services\ProfileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Stripe\Exception\ApiErrorException;

class UserController extends Controller
{
    /**
     * @var ProfileService
     */
    private ProfileService $profileService;


    /**
     * @param ProfileService $profileService
     */

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
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
        $profileList = $this->profileService->profileList();

        return view('account/profile', ['subscriptions' => $profileList['subscriptions'],
            'user' => $profileList['user'],
            'card' => $profileList['card']
        ]);
    }
}
