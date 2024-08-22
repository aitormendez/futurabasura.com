<footer class="flex flex-wrap mt-20">

    <div class="flex flex-wrap w-full md:w-1/2 bg-white font-bugrino md:text-xl font-light">
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-r-2 border-b-2 border-black">
            @foreach ($contents_nav as $item)
            <li>
                <a href="{{ $item->url }}" class="hover:text-azul font-light">{{ $item->label }}</a>
            </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-b-2 border-black">
            @foreach ($shop_nav as $item)
            <li>
                <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
            </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-r-2 border-black">
            @foreach ($social_nav as $item)
            <li>
                <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
            </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6">
            @foreach ($footer_pages_nav as $item)
            <li>
                <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- desktop --}}
    <div class="hidden md:flex flex-col justify-between items-center w-1/2 border-l-2 border-black p-6 font-bugrino"
        style="background-color: {{ get_field('footer_color', 'option') }}">
        <div class="w-1/3 mt-[5vw]">
            @svg('images.logo-fb')
        </div>
        <div class="text-xl text-center mb-[3vw] font-light">
            {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex md:!hidden flex-wrap w-full font-bugrino">
        <div class="arriba flex flex-wrap w-full h-[50vw] my-4">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex justify-center items-center w-1/2"
                style="background-color: {{ get_field('footer_color', 'option') }}">
                @svg('images.logo-fb', 'w-1/2')
            </div>
        </div>
        <div class="abajo flex flex-wrap w-full h-[50vw]">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 text-sm p-4" style="background-color: {{ get_field('footer_color', 'option') }}">
                {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}

    <div class="flex w-full flex-col md:flex-row items-center md:bg-white formulario mt-12 mb-20">
        <div
            class="flex flex-col justify-center items-center sombra w-[25vw] leading-relaxed text-lg py-6 md:py-0 grow-0 shrink-0">
            <span>Join</span><span>newsletter</span>
        </div>
        <div class="flex bg-white md:border-l-2 border-black w-full">

            <div id="mc_embed_shell" class="w-full">
                <div id="mc_embed_signup" class="h-full">
                    <form class="w-full h-full"
                        action="https://futurabasura.us6.list-manage.com/subscribe/post?u=291a8b51f4f3fd74d185a9ea8&amp;id=82d19ee1ff&amp;f_id=00251ce3f0"
                        method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                        target="_blank">
                        <div id="mc_embed_signup_scroll" class="flex h-full">
                            <div class="izquierda w-[50vw] shrink-0">
                                <div class="mc-field-group h-full"><label class="hidden" for="mce-EMAIL">Email
                                        Address<span class="asterisk">*</span></label><input type="email" name="EMAIL"
                                        class="required email font-bugrino bg-azul-claro h-full w-full p-6 text-2xl"
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

                            <div class="clear foot grow-0 shrink-1 w-full">
                                <input type="submit" name="subscribe" id="mc-embedded-subscribe"
                                    class="button !bg-azul text-white w-full h-full hover:!bg-allo hover:!text-black cursor-pointer"
                                    value="Subscribe">
                            </div>

                        </div>
                    </form>
                    <div class="email-error-container"></div>
                </div>
                <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js">
                </script>
                <script type="text/javascript">
                    (function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';/*
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
                        });}(jQuery));var $mcj = jQuery.noConflict(true);
                </script>
            </div>

        </div>
    </div>

    {{-- desktop --}}
    <div class="hidden md:flex flex-wrap bg-white w-full my-6 pb-6">
        <ul class="p-6 font-bugrino flex gap-4 w-full text-xl justify-center mb-20">
            @foreach ($legal_nav as $item)
            <li class="">
                <a href="{{ $item->url }}" class="hover:text-azul font-light">{{ $item->label }}</a>
            </li>
            @endforeach
        </ul>

        <div class="w-2/3 pl-6">
            <div>
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="columns-2 mt-12 text-xs uppercase max-w-[600px]">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
        </div>
        <div class="flex flex-col w-1/3 items-end pr-6 justify-between">
            <a class="hover:text-azul" href="https://www.instagram.com/futurabasura/">
                <x-fab-instagram class="w-8" alt="instagram" />
            </a>
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos w-full flex justify-center mt-16 gap-8">
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
    <div class="flex md:!hidden flex-wrap w-full bg-white">
        <div class="arriba flex flex-wrap w-full h-[20px]">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex justify-center items-center w-1/2"
                style="background-color: {{ get_field('footer_color', 'option') }}">
            </div>
        </div>

        <ul class="px-6 font-bugrino flex flex-col w-1/2">
            @foreach ($legal_nav as $item)
            <li class="">
                <a href="{{ $item->url }}" class="hover:text-azul font-light">{{ $item->label }}</a>
            </li>
            @endforeach
        </ul>

        <div class="w-full text-sm pl-6 mt-6">
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos w-full flex justify-center mt-16 gap-4 px-6">
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
            <div class="columns-2 mt-12 text-xs uppercase max-w-[600px]">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}

</footer>