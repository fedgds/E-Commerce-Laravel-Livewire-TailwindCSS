<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
    <h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Giỏ hàng</h1>
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row gap-4">
        <div class="md:w-3/4">
          <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
            <table class="w-full">
              <thead>
                <tr>
                  <th class="text-center font-semibold">Tên sản phẩm</th>
                  <th class="text-center font-semibold">Ảnh</th>
                  <th class="text-center font-semibold">Giá</th>
                  <th class="text-center font-semibold">Số lượng</th>
                  <th class="text-center font-semibold">Tổng</th>
                  <th class="text-center font-semibold">Xóa</th>
                </tr>
              </thead>
              <tbody>
                @php $grand_total = 0; @endphp
                @forelse ($cart_items as $item)
                  @php $item_total = $item['unit_amount'] * $item['quantity']; @endphp
                  @php $grand_total += $item_total; @endphp
                  <tr class="text-center" wire:key='{{ $item['product_id'] }}'>
                    <td class="py-4">
                      <span class="font-semibold">{{ $item['name'] }}</span>
                    </td>
                    <td>
                      <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="">
                    </td>
                    <td class="py-4">
                      {{ number_format($item['unit_amount']) }} đ
                    </td>
                    <td class="py-4">
                        <button wire:click='decreaseQty({{ $item['product_id'] }})' class="border rounded-md py-1 px-2 mr-2 hover:bg-rose-300">-</button>
                        <span class="text-center w-8">{{ $item['quantity'] }}</span>
                        <button wire:click='increaseQty({{ $item['product_id'] }})' class="border rounded-md py-1 px-2 ml-2 hover:bg-rose-300">+</button>
                    </td>
                    <td class="py-4">
                      {{ number_format($item_total) }} đ
                    </td>
                    <td>
                      <button wire:click='removeItem({{ $item['product_id'] }})' class="bg-black text-white rounded-full p-1 hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-xl text-center font-bold pt-3">Chưa có sản phẩm nào trong giỏ hàng</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="md:w-1/4">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Tóm tắt</h2>
            <div class="flex justify-between mb-2">
              <span>Tổng tiền</span>
              <span>{{ number_format($grand_total) }} đ</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Thuế</span>
              <span>0 đ</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Phí vận chuyển</span>
              <span>0 đ</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Tổng cộng</span>
              <span class="font-semibold">{{ number_format($grand_total) }} đ</span>
            </div>
            @if ($cart_items)
              <a href="/checkout" class="bg-gray-900 hover:bg-rose-600 block text-center text-white py-2 px-4 rounded-lg mt-4 w-full">Thanh toán</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
