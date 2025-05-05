@if (count($cupones) !== 0)
    <section class="alignfull">
        @foreach ($cupones as $cupon)
            <div class="cupon-wrap bg-allo my-6 flex justify-center">
                <div class="cupon md:2/6 lg:3/12 xl:2/12 inline-flex w-5/6 justify-between sm:w-1/2">
                    <div class="punteado bg-punteado"></div>
                    <div class="textos flex flex-col justify-center p-3">
                        <h3 class="text-center font-bold">{{ $cupon->post_title }}</h3>
                        <div class="excerpt text-center">
                            {{ $cupon->post_excerpt }}
                        </div>
                    </div>
                    <div class="punteado bg-punteado"></div>
                </div>
            </div>
        @endforeach
    </section>
@endif
