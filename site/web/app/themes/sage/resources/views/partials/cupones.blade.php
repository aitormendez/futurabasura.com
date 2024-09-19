@if (count($cupones) !== 0)
  <section>
    @foreach ($cupones as $cupon)
      <div class="flex justify-center my-6 cupon-wrap bg-allo">
        <div class="inline-flex justify-between w-5/6 cupon sm:w-1/2 md:2/6 lg:3/12 xl:2/12">
          <div class="punteado bg-punteado"></div>
          <div class="flex flex-col justify-center p-3 textos">
            <h3 class="font-bold text-center">{{ $cupon->post_title }}</h3>
            <div class="text-center excerpt">
              {{ $cupon->post_excerpt }}
            </div>
          </div>
          <div class="punteado bg-punteado"></div>
        </div>
      </div>
    @endforeach
  </section>
@endif
