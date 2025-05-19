<!-- Page Layout -->
<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        Product Registration
    </x-slot>

    <div class="container mt-8 max-1180:px-5 max-md:mt-6 max-md:px-4">
        <!-- Form Container -->
		<div class="m-auto w-full max-w-[870px] rounded-xl border border-zinc-200 p-16 px-[90px] max-md:px-8 max-md:py-8 max-sm:border-none max-sm:p-0">
			<h1 class="font-dmserif text-4xl max-md:text-3xl max-sm:text-xl">
                Product Registration
            </h1>

			<p class="mt-4 text-xl text-zinc-500 max-sm:mt-1 max-sm:text-sm">
                Extend your product warranty. We offer one stop support to resolve your issues over phone support or in person visit.
            </p>

            <p class="mt-4 text-xl text-zinc-500 max-sm:mt-1 max-sm:text-sm">
                To extend your warranty, all you need to do is fill up the form, upload the invoice and share it with us.
            </p>

            <div class="mt-14 rounded max-sm:mt-8">
                <!-- Contact Form -->
                <x-shop::form :action="route('shop.home.product_registration.send_mail')"
                    enctype="multipart/form-data">
                    <!-- Name -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.home.contact.name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="name"
                            rules="required"
                            :value="old('name')"
                            :label="trans('shop::app.home.contact.name')"
                            :placeholder="trans('shop::app.home.contact.name')"
                            :aria-label="trans('shop::app.home.contact.name')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="name" />
                    </x-shop::form.control-group>

                    <!-- Email -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.home.contact.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="email"
                            rules="required|email"
                            :value="old('email')"
                            :label="trans('shop::app.home.contact.email')"
                            :placeholder="trans('shop::app.home.contact.email')"
                            :aria-label="trans('shop::app.home.contact.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    <!-- Contact -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.home.contact.phone-number')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="contact"
                            rules="required|phone"
                            :value="old('contact')"
                            :label="trans('shop::app.home.contact.phone-number')"
                            :placeholder="trans('shop::app.home.contact.phone-number')"
                            :aria-label="trans('shop::app.home.contact.phone-number')"
                        />

                        <x-shop::form.control-group.error control-name="contact" />
                    </x-shop::form.control-group>

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            Product Name
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="product_name"
                            rules="required"
                            :value="old('product_name')"
                            :label="'Product Name'"
                            :placeholder="'Product Name'"
                            :aria-label="'Product Name'"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="product_name" />
                    </x-shop::form.control-group>

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            Date Of Purchase
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="date"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="date_of_purchase"
                            rules="required"
                            :value="old('date_of_purchase')"
                            :label="'Date Of Purchase'"
                            :placeholder="'Date Of Purchase'"
                            :aria-label="'Date Of Purchase'"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="date_of_purchase" />
                    </x-shop::form.control-group>

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            Pin Code
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="pin_code"
                            rules="required"
                            :value="old('pin_code')"
                            :label="'Pin Code'"
                            :placeholder="'Pin Code'"
                            :aria-label="'Pin Code'"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="pin_code" />
                    </x-shop::form.control-group>

                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            Purchased from
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="select"
                            class="px-6 py-5 max-md:py-3 max-sm:py-3.5"
                            name="purchased_from"
                            rules="required"
                            :value="old('purchased_from')"
                            :label="'Purchased from'"
                            :placeholder="'Purchased from'"
                            :aria-label="'Purchased from'"
                            aria-required="true"
                        >
                                @foreach([
                                    'AGARO Brand Website',
                                    'Amazon',
                                    'FlipKart',
                                    'Myntra',
                                    'Nykaa',
                                    'Firstcry',
                                    'Shop',
                                    'Shopping Mall',
                                    'Medicine Shop',
                                    'Doctors Chamber',
                                    'Dental Clinic',
                                    'Physio',
                                    'Blinkit',
                                    'Zepto',
                                    'Swiggy Instamart'
                                ] as $type)
                                    <option
                                        value="{{ $type }}"
                                        {{ $type === 'text' ? "selected" : '' }}
                                    >
                                        {{ $type }}
                                    </option>
                                @endforeach
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.error control-name="purchased_from" />
                    </x-shop::form.control-group>

                     <!-- Images Directory Path -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Upload Invoice/Proof of Purchase for Warranty Registration
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="file"
                            name="file"
                            rules="required"
                            :label="'Upload Invoice/Proof of Purchase for Warranty Registration'"
                            :aria-label="'Upload Invoice/Proof of Purchase for Warranty Registration'"
                            aria-required="true"
                        />

                        <x-admin::form.control-group.error control-name="file" />
                    </x-admin::form.control-group>

                    <!-- Re captcha -->
                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <div class="mb-5 flex">
                            {!! Captcha::render() !!}
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="mt-8 flex flex-wrap items-center gap-9 max-sm:justify-center max-sm:text-center">
                        <button
                            class="primary-button m-0 mx-auto block w-full max-w-[374px] rounded-2xl px-11 py-4 text-center text-base max-md:max-w-full max-md:rounded-lg max-md:py-3 max-sm:py-1.5 ltr:ml-0 rtl:mr-0"
                            type="submit"
                        >
                            @lang('shop::app.home.contact.submit')
                        </button>
                    </div>
                </x-shop::form>
            </div>
		</div>
    </div>
`
    @push('scripts')
        {!! Captcha::renderJS() !!}
    @endpush
</x-shop::layouts>
