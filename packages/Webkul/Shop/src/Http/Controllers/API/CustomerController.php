<?php

namespace Webkul\Shop\Http\Controllers\API;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use Webkul\Shop\Http\Requests\Customer\LoginRequest;
use Illuminate\Support\Facades\Mail;
use Webkul\Shop\Mail\Customer\EmailVerificationNotification;

class CustomerController extends APIController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CustomerRepository $customerRepository
    ) {}
    /**
     * Login Customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (! auth()->guard('customer')->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => trans('shop::app.customers.login-form.invalid-credentials'),
            ], Response::HTTP_FORBIDDEN);
        }

        if (! auth()->guard('customer')->user()->status) {
            auth()->guard('customer')->logout();

            return response()->json([
                'message' => trans('shop::app.customers.login-form.not-activated'),
            ], Response::HTTP_FORBIDDEN);
        }

        if (! auth()->guard('customer')->user()->is_verified) {
            Cookie::queue(Cookie::make('enable-resend', 'true', 1));

            Cookie::queue(Cookie::make('email-for-resend', $request->get('email'), 1));

            $email = $request->get('email');

            $verificationData = [
                'email' => $email,
                'token' => md5(uniqid(rand(), true)),
            ];

            $customer = $this->customerRepository->findOneByField('email', $email);

            $this->customerRepository->update(['token' => $verificationData['token']], $customer->id);

            try {
                Mail::queue(new EmailVerificationNotification($verificationData));

                if (Cookie::has('enable-resend')) {
                    \Cookie::queue(\Cookie::forget('enable-resend'));
                }

                if (Cookie::has('email-for-resend')) {
                    \Cookie::queue(\Cookie::forget('email-for-resend'));
                }
            } catch (\Exception $e) {
            }

            auth()->guard('customer')->logout();

            return response()->json([
                'message' => trans('shop::app.customers.login-form.verify-first'),
            ], Response::HTTP_FORBIDDEN);
        }

        /**
         * Event passed to prepare cart after login.
         */
        Event::dispatch('customer.after.login', auth()->guard()->user());

        return response()->json([]);
    }
}
