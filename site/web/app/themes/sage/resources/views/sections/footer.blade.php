<footer class="mt-20 flex flex-wrap">

    <div class="flex w-full flex-wrap bg-white font-bugrino font-light md:w-1/2 md:text-xl lg:text-2xl">
        <ul class="h-[40vw] w-1/2 border-b-2 border-r-2 border-black p-6 md:h-[20vw]">
            @foreach ($contents_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 border-b-2 border-black p-6 md:h-[20vw]">
            @foreach ($shop_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 border-r-2 border-black p-6 md:h-[20vw]">
            @foreach ($social_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 p-6 md:h-[20vw]">
            @foreach ($footer_pages_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- desktop --}}
    <div class="hidden w-1/2 flex-col items-center justify-between border-l-2 border-black p-6 font-bugrino md:flex"
        style="background-color: {{ get_field('footer_color', 'option') }}">
        <div class="mt-[5vw] w-1/3">
            @svg('images.logo-fb')
        </div>
        <div class="mb-[3vw] text-center text-xl font-light">
            {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex w-full flex-wrap font-bugrino md:!hidden">
        <div class="arriba my-4 flex h-[50vw] w-full flex-wrap">
            <div class="izq flex w-1/2 items-stretch justify-end bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 items-center justify-center"
                style="background-color: {{ get_field('footer_color', 'option') }}">
                @svg('images.logo-fb', 'w-1/2')
            </div>
        </div>
        <div class="abajo flex h-[50vw] w-full flex-wrap">
            <div class="izq flex w-1/2 items-stretch justify-end bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 p-4 text-sm"
                style="background-color: {{ get_field('footer_color', 'option') }}">
                {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}

    <div class="formulario mb-20 mt-12 flex w-full flex-col items-center md:!flex-row md:bg-white">
        <div
            class="sombra flex w-[25vw] shrink-0 grow-0 flex-col items-center justify-center py-6 text-lg leading-relaxed md:py-0">
            <span>Join</span><span>newsletter</span>
        </div>
        <div class="flex w-full border-black bg-white md:border-l-2">

            <div id="mc_embed_shell" class="w-full">
                <div id="mc_embed_signup" class="h-full">
                    <form class="h-full w-full"
                        action="https://futurabasura.us6.list-manage.com/subscribe/post?u=291a8b51f4f3fd74d185a9ea8&amp;id=82d19ee1ff&amp;f_id=00251ce3f0"
                        method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                        class="validate" target="_blank">
                        <div id="mc_embed_signup_scroll" class="flex h-full">
                            <div class="izquierda w-[50vw] shrink-0">
                                <div class="mc-field-group h-full"><label class="hidden" for="mce-EMAIL">Email
                                        Address<span class="asterisk">*</span></label><input type="email"
                                        name="EMAIL"
                                        class="required email h-full w-full bg-azul-claro p-6 font-bugrino text-2xl"
                                        id="mce-EMAIL" required="" value="" placeholder="Email">
                                </div>

                                <div id="mce-responses" class="clear foot">
                                    <div class="response" id="mce-error-response" style="display: none;"></div>
                                    <div class="response" id="mce-success-response" style="display: none;"></div>
                                </div>
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    /* real people should not fill this in and expect good things - do not remove this
                                    or
                                    risk form bot signups */
                                    <input type="text" name="b_291a8b51f4f3fd74d185a9ea8_82d19ee1ff" tabindex="-1"
                                        value="">
                                </div>
                            </div>

                            <div class="clear foot shrink-1 w-full grow-0">
                                <input type="submit" name="subscribe" id="mc-embedded-subscribe"
                                    class="button h-full w-full cursor-pointer !bg-azul text-white hover:!bg-allo hover:!text-black"
                                    value="Subscribe">
                            </div>

                        </div>
                    </form>
                    <div class="email-error-container"></div>
                </div>
                <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
                <script type="text/javascript">
                    (function($) {
                        window.fnames = new Array();
                        window.ftypes = new Array();
                        fnames[0] = 'EMAIL';
                        ftypes[0] = 'email';
                        fnames[1] = 'FNAME';
                        ftypes[1] = 'text';
                        fnames[2] = 'LNAME';
                        ftypes[2] = 'text';
                        fnames[3] = 'ADDRESS';
                        ftypes[3] = 'address';
                        fnames[4] = 'PHONE';
                        ftypes[4] = 'phone';
                        fnames[5] = 'BIRTHDAY';
                        ftypes[5] = 'birthday';
                        /*
                         * Translated default messages for the $ validation plugin.
                         * Locale: ES
                         */
                        $.extend($.validator.messages, {
                            required: "This field is required.",
                            remote: "Please fill out this field.",
                            email: "Please enter a valid email address.",
                            url: "Please enter a valid URL.",
                            date: "Please enter a valid date.",
                            dateISO: "Please enter a valid date (ISO).",
                            number: "Please enter a valid number.",
                            digits: "Please enter only digits.",
                            creditcard: "Please enter a valid credit card number.",
                            equalTo: "Please enter the same value again.",
                            accept: "Please enter a value with a valid extension.",
                            maxlength: $.validator.format("Please do not enter more than {0} characters."),
                            minlength: $.validator.format("Please enter at least {0} characters."),
                            rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
                            range: $.validator.format("Please enter a value between {0} and {1}."),
                            max: $.validator.format("Please enter a value less than or equal to {0}."),
                            min: $.validator.format("Please enter a value greater than or equal to {0}.")
                        });
                    }(jQuery));
                    var $mcj = jQuery.noConflict(true);
                </script>
            </div>

        </div>
    </div>

    {{-- desktop --}}
    <div class="my-6 hidden w-full flex-wrap bg-white pb-6 md:flex">
        <ul class="mb-20 flex w-full justify-center gap-4 p-6 font-bugrino text-xl">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="w-2/3 pl-6">
            <div>
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="mt-12 max-w-[600px] columns-2 text-xs uppercase">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
        </div>
        <div class="flex w-1/3 flex-col items-end justify-between pr-6">
            <a class="hover:text-azul" href="https://www.instagram.com/futurabasura/">
                <x-fab-instagram class="w-8" alt="instagram" />
            </a>
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos mt-16 flex w-full justify-center gap-8">
            <x-fab-cc-visa class="w-12" alt="Visa" />
            <x-custom-paypal class="w-16" alt="Bizum" />
            <x-fab-cc-mastercard class="w-12" alt="Mastercard" />
            <x-fab-apple-pay class="w-14" alt="Apple Pay" />
            <x-fab-google-pay class="w-14" alt="Google Pay" />
            <x-custom-bizum class="w-20" alt="Bizum" />
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex w-full flex-wrap bg-white md:!hidden">
        <div class="arriba flex h-[20px] w-full flex-wrap">
            <div class="izq flex w-1/2 items-stretch justify-end bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 items-center justify-center"
                style="background-color: {{ get_field('footer_color', 'option') }}">
            </div>
        </div>

        <ul class="flex w-1/2 flex-col px-6 font-bugrino">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 w-full pl-6 text-sm">
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos mt-16 flex w-full justify-center gap-4 px-6">
            <x-fab-cc-visa class="w-12" alt="Visa" />
            <x-custom-paypal class="w-16" alt="Bizum" />
            <x-fab-cc-mastercard class="w-12" alt="Mastercard" />
            <x-fab-apple-pay class="w-14" alt="Apple Pay" />
            <x-fab-google-pay class="w-14" alt="Google Pay" />
            <x-custom-bizum class="w-20" alt="Bizum" />
        </div>

        <div class="w-full p-6 text-xs">
            <div>
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="mt-12 max-w-[600px] columns-2 text-xs uppercase">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}

</footer>
