<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Webkul\Shop\Http\Requests\ContactRequest;
use Webkul\Shop\Http\Requests\ProductRegistrationRequest;
use Webkul\Shop\Mail\ContactUs;
use Webkul\Shop\Mail\ProductRegistration;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

class HomeController extends Controller
{
    /**
     * Using const variable for status
     */
    const STATUS = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ThemeCustomizationRepository $themeCustomizationRepository) {}

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        visitor()->visit();

        $customizations = $this->themeCustomizationRepository->orderBy('sort_order')->findWhere([
            'status'     => self::STATUS,
            'channel_id' => core()->getCurrentChannel()->id,
            'theme_code' => core()->getCurrentChannel()->theme,
        ]);

        return view('shop::home.index', compact('customizations'));
    }

    /**
     * Loads the home page for the storefront if something wrong.
     *
     * @return \Exception
     */
    public function notFound()
    {
        abort(404);
    }

    /**
     * Summary of contact.
     *
     * @return \Illuminate\View\View
     */
    public function contactUs()
    {
        return view('shop::home.contact-us');
    }

    /**
     * Summary of store.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendContactUsMail(ContactRequest $contactRequest)
    {
        try {
            Mail::queue(new ContactUs($contactRequest->only([
                'name',
                'email',
                'contact',
                'message',
            ])));

            session()->flash('success', trans('shop::app.home.thanks-for-contact'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            report($e);
        }

        return back();
    }

    public function productRegistration()
    {
        return view('shop::home.product-registration');
    }

    public function sendProductRegistrationMail(ProductRegistrationRequest $productRegistrationRequest)
    {
        $requestArray = $productRegistrationRequest->only([
                'name',
                'email',
                'contact',
                'product_name',
                'date_of_purchase',
                'pin_code',
                'purchased_from',
        ]);

        if (request()->file('file') && request()->file('file')->isValid()) {

            $requestArray['file_path'] = storage_path('app/public') . '/' . request()->file('file')->storeAs(
                'locales',
                time().'-'.request()->file('file')->getClientOriginalName()
            );
        }


        try {
            Mail::to($requestArray['email'])->send(new ProductRegistration($requestArray));

            session()->flash('success', 'Your request has been received successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            report($e);
        }

        return back();
    }

}
