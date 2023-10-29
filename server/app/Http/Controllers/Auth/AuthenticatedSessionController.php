<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\AuthenticatedRepository;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * @var AuthenticatedRepository
     */
    private AuthenticatedRepository $notesRepository;

    /**
     * @param AuthenticatedRepository $AuthenticatedRepository
     */
    public function __construct(AuthenticatedRepository $AuthenticatedRepository)
    {
        $this->AuthenticatedRepository = $AuthenticatedRepository;
    }
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = $this->AuthenticatedRepository->getUserName($request);

        if ($user) {
            $userName = $user->name;

            $request->session()->put('username', $userName);
        }

        return redirect('/');
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
