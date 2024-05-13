<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
      <h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Sản phẩm</h1>
      <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
        <div class="flex flex-wrap mb-24 -mx-3">
          <div class="w-full pr-2 lg:w-1/4 lg:block">
            <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
              <h2 class="text-2xl font-bold dark:text-gray-400"> Danh mục</h2>
              <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
              <ul>
                
                @foreach ($categories as $category)
                  <li class="mb-4" wire:key="{{ $category->id }}">
                    <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400 ">
                      <input type="checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                      <span class="text-lg">{{ $category->name }}</span>
                    </label>
                  </li>
                @endforeach

              </ul>
  
            </div>
            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
              <h2 class="text-2xl font-bold dark:text-gray-400">Thương hiệu</h2>
              <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
              <ul>

                @foreach ($brands as $brand)
                  <li class="mb-4" wire:key="{{ $brand->id }}">
                    <label for="{{ $brand->slug }}" class="flex items-center dark:text-gray-400 ">
                      <input type="checkbox" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}" class="w-4 h-4 mr-2">
                      <span class="text-lg">{{ $brand->name }}</span>
                    </label>
                  </li>
                @endforeach

              </ul>
            </div>
            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
              <h2 class="text-2xl font-bold dark:text-gray-400">Trạng thái</h2>
              <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
              <ul>
                <li class="mb-4">
                  <label for="featured" class="flex items-center dark:text-gray-300">
                    <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="w-4 h-4 mr-2">
                    <span class="text-lg dark:text-gray-400">Nổi bật</span>
                  </label>
                </li>
                <li class="mb-4">
                  <label for="on_sale" class="flex items-center dark:text-gray-300">
                    <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2">
                    <span class="text-lg dark:text-gray-400">Giảm giá</span>
                  </label>
                </li>
              </ul>
            </div>
  
            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
              <h2 class="text-2xl font-bold dark:text-gray-400">Giá</h2>
              <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
              <div>
                <input type="range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-rose-100 rounded appearance-none cursor-pointer" max="50000000" value="0" step="0">
                <div class="flex justify-between ">
                  <span class="inline-block text-lg font-bold text-rose-400 ">{{ number_format('0') }} đ</span>
                  <span class="inline-block text-lg font-bold text-rose-400 ">{{ number_format('50000000') }} đ</span>
                </div>
                <div class="font-semibold text-2xl text-rose-600">{{ number_format($price_range) }} đ</div>
              </div>
            </div>
          </div>
          <div class="w-full px-3 lg:w-3/4">
            <div class="px-3 mb-4">
              <div class="items-center justify-between hidden md:flex dark:bg-gray-900 ">
                <div class="flex items-center justify-between">
                  <select wire:model.live="sort" class="block w-50 text-base bg-gray-200 px-3 py-2 cursor-pointer dark:text-gray-400 dark:bg-gray-900 rounded-lg">
                    <option value="latest">Sắp xếp theo mới nhất</option>
                    <option value="price_asc">Sắp xếp theo giá tăng dần</option>
                    <option value="price_desc">Sắp xếp theo giá giảm dần</option>
                </select>
                </div>
              </div>
            </div>
            <div class="flex flex-wrap items-center ">
              
              @foreach($products as $product)
                <div class="w-full h-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                  <div class="border border-gray-300 dark:border-gray-700">
                    <div class="relative bg-gray-200">
                      <a href="/products/{{ $product->slug }}" class="">
                        <img src="{{ url('storage', $product->images[0]) }}" alt="" class="object-cover w-full h-56 mx-auto ">
                      </a>
                    </div>
                    <div class="p-3 ">
                      <div class="flex items-center justify-between gap-2 mb-2">
                        <h3 class="text-x font-medium dark:text-gray-400">
                          {{ strlen($product->name) > 23 ? substr($product->name, 0, 23) . '...' : $product->name }}
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
    
                      <a wire:click.prevent='addToCart({{ $product->id }})' href="" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                        </svg>
                        <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Thêm vào giỏ</span>
                        <span wire:loading wire:target='addToCart({{ $product->id }})'>Đang thêm...</span>
                      </a>
    
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
            <!-- pagination start -->
            <div class="flex justify-end mt-6">
              {!! $products->links() !!}
            </div>
            <!-- pagination end -->
          </div>
        </div>
      </div>
    </section>
  
  </div>