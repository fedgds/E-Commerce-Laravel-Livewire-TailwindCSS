<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
    <h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Đơn hàng của tôi</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 p-4">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Số đơn hàng</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Trạng thái đơn hàng</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Trạng thái thanh toán</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Số tiền</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ngày đặt</th>
                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order as $item)
                  <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800 text-center">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $item->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                      @if ($item->status == 'new')
                        <span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Mới</span>
                      @elseif($item->status == 'processing')
                        <span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Đang xử lý</span>
                      @elseif($item->status == 'shipped')
                        <span class="bg-orange-500 py-1 px-3 rounded text-white shadow">Đang giao hàng</span>
                      @elseif($item->status == 'delivered')
                        <span class="bg-green-500 py-1 px-3 rounded text-white shadow">Đã giao hàng</span>
                      @elseif($item->status == 'cancel')
                        <span class="bg-rose-500 py-1 px-3 rounded text-white shadow">Đã hủy</span>
                      @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                      @if ($item->payment_status == 'pending')
                        <span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Chờ xử lý</span>
                      @elseif($item->payment_status == 'paid')
                        <span class="bg-green-500 py-1 px-3 rounded text-white shadow">Đã thanh toán</span>
                      @elseif($item->payment_status == 'failed')
                        <span class="bg-rose-500 py-1 px-3 rounded text-white shadow">Thất bại</span>
                      @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ number_format($item->grand_total) }} VND</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $item->created_at->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                      <a href="/my-orders/{{ $item->id }}" class="bg-slate-900 text-white py-2 px-4 rounded-md hover:bg-slate-700">Xem</a>
                    </td>
                  </tr> 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>