@php
    $channel = core()->getCurrentChannel();
@endphp

<!-- SEO Meta Content -->
@push ('meta')
    <meta name="title" content="{{ $channel->home_seo['meta_title'] ?? '' }}" />
    <meta name="description" content="{{ $channel->home_seo['meta_description'] ?? '' }}" />
    <meta name="keywords" content="{{ $channel->home_seo['meta_keywords'] ?? '' }}" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endPush

@push('scripts')
    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{  $channel->home_seo['meta_title'] ?? '' }}
    </x-slot>

    <!-- Loop over the theme customization -->
    @foreach ($customizations as $customization)
        @php ($data = $customization->options) @endphp

        <!-- Static content -->
        @switch ($customization->type)
            @case ($customization::IMAGE_CAROUSEL)
                <!-- Image Carousel -->
                <x-shop::carousel :options="$data" aria-label="Image Carousel" />
                @break
            @case ($customization::STATIC_CONTENT)
                <!-- push style -->
                @if (! empty($data['css']))
                    @push ('styles')
                        <style>
                            {{ $data['css'] }}
                        </style>
                    @endpush
                @endif

                <!-- render html -->
                @if (! empty($data['html']))
                    {!! $data['html'] !!}
                @endif
                @break
            @case ($customization::CATEGORY_CAROUSEL)
                <!-- Categories carousel -->
                <x-shop::categories.carousel
                    :title="$data['title'] ?? ''"
                    :src="route('shop.api.categories.index', $data['filters'] ?? [])"
                    :navigation-link="route('shop.home.index')"
                    aria-label="Categories Carousel"
                />
                @break
            @case ($customization::PRODUCT_CAROUSEL)
                <!-- Product Carousel -->
                <x-shop::products.carousel
                    :title="$data['title'] ?? ''"
                    :src="route('shop.api.products.index', $data['filters'] ?? [])"
                    :navigation-link="route('shop.search.index', $data['filters'] ?? [])"
                    aria-label="Product Carousel"
                />
                @break
        @endswitch
    @endforeach

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>
    <a id="whatsappBtn" href="https://wa.me/1234567890" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="WhatsApp">
    </a>

    @push('styles')
        <style>
            #scrollToTopBtn {
                display: none; /* Hidden by default */
                position: fixed;
                bottom: 20px;
                right: 80px;
                width: 50px;
                height: 50px;
                font-size: 18px;
                background: rgb(244 53 130 / var(--tw-bg-opacity));
                color: white;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                transition: opacity 0.3s, transform 0.3s;
                z-index: 1;
            }

            #scrollToTopBtn:hover {
                background: #fff;
                border: 1px solid #f43582;
                color: #f43582;
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
    @endpush

    @push('scripts')
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
    @endpush
</x-shop::layouts>
