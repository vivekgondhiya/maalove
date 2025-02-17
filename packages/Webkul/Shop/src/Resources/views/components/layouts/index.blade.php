@props([
    'hasHeader'  => true,
    'hasFeature' => true,
    'hasFooter'  => true,
])

<!DOCTYPE html>

<html
    lang="{{ app()->getLocale() }}"
    dir="{{ core()->getCurrentLocale()->direction }}"
>
    <head>

        {!! view_render_event('bagisto.shop.layout.head.before') !!}

        <title>{{ $title ?? '' }}</title>

        <meta charset="UTF-8">

        <meta
            http-equiv="X-UA-Compatible"
            content="IE=edge"
        >
        <meta
            http-equiv="content-language"
            content="{{ app()->getLocale() }}"
        >

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >
        <meta
            name="base-url"
            content="{{ url()->to('/') }}"
        >
        <meta
            name="currency"
            content="{{ core()->getCurrentCurrency()->toJson() }}"
        >

        @stack('meta')

        <link
            rel="icon"
            sizes="16x16"
            href="{{ core()->getCurrentChannel()->favicon_url ?? bagisto_asset('images/favicon.ico') }}"
        />

        @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'])

        <link
            rel="preload"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
            as="style"
        >
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        >

        <link
            rel="preload"
            href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap"
            as="style"
        >
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap"
        >

        <link
            rel="preload"
            href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
            as="style"
        >
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        >

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        @stack('styles')

        <style>
            #scrollToTopBtn {
                display: none; /* Hidden by default */
                position: fixed;
                bottom: 20px;
                right: 80px;
                width: 50px;
                height: 50px;
                font-size: 18px;
                /* background: rgb(244 53 130 / var(--tw-bg-opacity));
                color: white;
                border: none; */

                background: #fff;
                border: 1px solid #f43582;
                color: #f43582;

                border-radius: 50%;
                cursor: pointer;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                transition: opacity 0.3s, transform 0.3s;
                z-index: 1;
            }

            #scrollToTopBtn:hover {
                background: #f43582;
                border: 1px solid #fff;
                color: #fff;
            }

            #scrollToTopBtn.show {
                display: block;
                opacity: 1;
                transform: scale(1);
            }

            #scrollToTopBtn.hide {
                opacity: 0;
                transform: scale(0.9);
            }

            #whatsappBtn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                z-index: 1000;
                transition: transform 0.3s, opacity 0.3s;
            }

            #whatsappBtn img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            }

            #whatsappBtn:hover {
                transform: scale(1.1);
            }
        </style>

        <style>
            {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
        </style>

        {!! view_render_event('bagisto.shop.layout.head.after') !!}

    </head>

    <body>
        {!! view_render_event('bagisto.shop.layout.body.before') !!}

        <a
            href="#main"
            class="skip-to-main-content-link"
        >
            Skip to main content
        </a>

        <div id="app">
            <!-- Flash Message Blade Component -->
            <x-shop::flash-group />

            <!-- Confirm Modal Blade Component -->
            <x-shop::modal.confirm />

            <div class="home-offer" style="background-color: #00a3eb; ">
                <h1 style="background-color: #00a3eb; color: #fff; padding: 2px; font-size: 18px; text-align: center;">Get UPTO 40% OFF on your 1st order SHOP NOW</h1>
            </div>

            <!-- Page Header Blade Component -->
            @if ($hasHeader)
                <x-shop::layouts.header />
            @endif

            {!! view_render_event('bagisto.shop.layout.content.before') !!}

            <!-- Page Content Blade Component -->
            <main id="main" class="bg-white">
                {{ $slot }}
            </main>

            {!! view_render_event('bagisto.shop.layout.content.after') !!}


            <!-- Page Services Blade Component -->
            @if ($hasFeature)
                <x-shop::layouts.services />
            @endif

            <!-- Page Footer Blade Component -->
            @if ($hasFooter)
                <x-shop::layouts.footer />
            @endif
        </div>

        {!! view_render_event('bagisto.shop.layout.body.after') !!}

        @stack('scripts')

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.before') !!}
        <script>
            /**
             * Load event, the purpose of using the event is to mount the application
             * after all of our `Vue` components which is present in blade file have
             * been registered in the app. No matter what `app.mount()` should be
             * called in the last.
             */
            window.addEventListener("load", function (event) {
                app.mount("#app");
            });
        </script>

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.after') !!}

        <script type="text/javascript">
            {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
        </script>

    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var btn = $('#scrollToTopBtn');

            $(window).scroll(function () {
                // console.log($(window).scrollTop());

                if ($(window).scrollTop() > 300) {
                    console.log('show');

                    $('#scrollToTopBtn').attr('style', 'display: block;');
                } else {
                    console.log('hide');
                    $('#scrollToTopBtn').attr('style', '');
                }
            });

            $(document).on('click', '#scrollToTopBtn', function () {
                $('html, body').animate({ scrollTop: 0 }, 800); // Smooth scroll to top
            });
        });
    </script>
    </body>
</html>
