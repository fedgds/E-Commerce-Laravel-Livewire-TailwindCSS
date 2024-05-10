<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
    <h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Chi tiết sản phẩm</h1>
      <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
        <div class="flex flex-wrap -mx-4">
          <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage', $product->images[0]) }}' }">
            <div class="sticky top-0 z-10 overflow-hidden ">
              <div class="relative mb-6 lg:mb-10 lg:h-2/4 border border-gray-200">
                <img x-bind:src="mainImage" alt="" class="object-cover w-full lg:h-full z-10">
              </div>
              <div class="flex-wrap hidden md:flex ">
                @foreach ($product->images as $image)
                  <div class="w-1/2 p-2 sm:w-1/4" x-on:click="mainImage='{{ url('storage', $image) }}'">
                    <img src="{{ url('storage', $image) }}" alt="" class="object-cover w-full lg:h-20 cursor-pointer border border-gray-200 hover:border hover:border-rose-400">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="w-full px-4 md:w-1/2 ">
            <div class="lg:pl-20">
              <div class="mb-8 ">
                <div class="max-w-xl text-3xl font-bold dark:text-gray-400 md:text-4xl">
                  {{ $product->name }}
                  @if ($product->sale_price)
                    <span class="text-lg border border-rose-300 bg-rose-700 text-white px-2 py-1 rounded-full">-{{ round(($product->price-$product->sale_price)*100/$product->price) }} %</span>
                  @endif
                </div>
                <p class="inline-block mb-6 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                  @if ($product->sale_price)
                    <span class="font-bold text-xl mr-1 text-rose-600 dark:text-rose-600">{{ number_format($product->sale_price) }} đ</span>
                    <span class="font-bold text-sm line-through text-gray-800 dark:text-gray-800">{{ number_format($product->price) }} đ</span>
                  @else
                    <span class="font-bold text-rose-600 dark:text-rose-600">{{ number_format($product->price) }} đ</span>
                  @endif
                </p>

              </div>
              <div class="w-32 mb-8 ">
                <label for="" class="w-full pb-1 text-xl font-semibold text-gray-700 border-b border-rose-300 dark:border-gray-600 dark:text-gray-400">Số lượng</label>
                <div class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg">
                  <button class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                    <span class="m-auto text-2xl font-thin">-</span>
                  </button>
                  <input type="number" readonly class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black" placeholder="1">
                  <button class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                    <span class="m-auto text-2xl font-thin">+</span>
                  </button>
                </div>
              </div>
              <div class="flex flex-wrap items-center gap-4">
                <button class="w-full p-4 bg-gray-900 hover:bg-rose-600 rounded-md lg:w-2/5 dark:text-gray-200 text-gray-50 hover:bg-rose-600 dark:bg-rose-500 dark:hover:bg-rose-700">
                  Thêm vào giỏ</button>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-10">
          <h2 class="font-bold text-xl mb-5">Mô tả</h2>
          <p class="text-gray-700 dark:text-gray-400">{{ $product->description }}</p>
        </div>
        <div class="mt-10">
          <h2 class="font-bold text-xl mb-5">Sản phẩm liên quan</h2>
          <div class="flex flex-wrap items-center ">
              
            @foreach($relatedProducts as $product)
              <div class="w-full h-full px-3 mb-6 sm:w-1/2 md:w-1/4" wire:key="{{ $product->id }}">
                <div class="border border-gray-300 dark:border-gray-700">
                  <div class="relative bg-gray-200">
                    <a href="/products/{{ $product->slug }}" class="">
                      <img src="{{ url('storage', $product->images[0]) }}" alt="" class="object-cover w-full h-56 mx-auto ">
                    </a>
                  </div>
                  <div class="p-3 ">
                    <div class="flex items-center justify-between gap-2 mb-2">
                      <h3 class="text-x font-medium dark:text-gray-400">
                        {{ strlen($product->name) > 20 ? substr($product->name, 0, 20) . '...' : $product->name }}
                      </h3>
                      @if ($product->sale_price)
                        <span class="text-sm border border-rose-300 bg-rose-700 text-white px-1 rounded-full">-{{ round(($product->price-$product->sale_price)*100/$product->price) }} %</span>
                      @endif
                    </div>
                    <p class="text-l ">
                      @if ($product->sale_price)
                        <span class="font-bold mr-1 text-rose-600 dark:text-rose-600">{{ number_format($product->sale_price) }} đ</span>
                        <span class="font-bold text-sm line-through text-gray-800 dark:text-gray-800">{{ number_format($product->price) }} đ</span>
                      @else
                      <span class="font-bold text-rose-600 dark:text-rose-600">{{ number_format($product->price) }} đ</span>
                      @endif
                    </p>
                  </div>
                  <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
  
                    <a href="#" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                      </svg><span>Thêm vào giỏ</span>
                    </a>
  
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>
      </div>
    </section>
  </div>