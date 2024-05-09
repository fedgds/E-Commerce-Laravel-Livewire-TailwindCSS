<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
	<section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg p-4">
		<h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Thanh toán</h1>
		<div class="grid grid-cols-12 gap-4">
			<div class="md:col-span-12 lg:col-span-8 col-span-12">
				<!-- Card -->
				<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					<!-- Shipping Address -->
					<div class="mb-6">
						<h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
							Thông tin nhận hàng
						</h2>
						<div class="mt-4">
								<label class="block text-gray-700 dark:text-white mb-1" for="first_name">
									Họ và Tên
								</label>
								<input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="first_name" type="text" placeholder="Nhập họ và tên">
								</input>
						</div>
						<div class="mt-4">
							<label class="block text-gray-700 dark:text-white mb-1" for="phone">
								Số điện thoại
							</label>
							<input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" type="text" placeholder="Nhập số điện thoại">
							</input>
						</div>
						<div class="grid grid-cols-2 gap-4">
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="city">
									Thành phố
								</label>
								<input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="city" type="text">
								</input>
							</div>
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="address">
									Quận/Huyện
								</label>
								<input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="address" type="text">
								</input>
							</div>
						</div>
						<div class="mt-4">
							<label class="block text-gray-700 dark:text-white mb-1" for="phone">
								Địa chỉ
							</label>
							<input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" type="text" placeholder="Nhập địa chỉ">
							</input>
						</div>
					</div>
					<div class="text-lg font-semibold mb-4">
						Chọn phương thức thanh toán
					</div>
					<ul class="grid w-full gap-6 md:grid-cols-2">
						<li>
							<input class="hidden peer" id="hosting-small" name="hosting" required="" type="radio" value="hosting-small" />
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Momo
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
						</li>
						<li>
							<input class="hidden peer" id="hosting-big" name="hosting" type="radio" value="hosting-big">
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Tiền mặt
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
							</input>
						</li>
					</ul>
				</div>
				<!-- End Card -->
			</div>
			<div class="md:col-span-12 lg:col-span-4 col-span-12">
				<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					<div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
						Tóm tắt đơn hàng
					</div>
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Tổng tiền
						</span>
						<span>
							45,000.00
						</span>
					</div>
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Thuế
						</span>
						<span>
							0.00
						</span>
					</div>
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Phí giao hàng
						</span>
						<span>
							0.00
						</span>
					</div>
					<hr class="bg-slate-400 my-4 h-1 rounded">
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Tổng cộng
						</span>
						<span>
							45,000.00
						</span>
					</div>
					</hr>
				</div>
				<button class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
					Đặt hàng
				</button>
				<div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					<div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
						Giỏ hàng
					</div>
					<ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
						<li class="py-3 sm:py-4">
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<img alt="Neil image" class="w-12 h-12 rounded-full" src="https://iplanet.one/cdn/shop/files/iPhone_15_Pro_Max_Blue_Titanium_PDP_Image_Position-1__en-IN_1445x.jpg?v=1695435917">
									</img>
								</div>
								<div class="flex-1 min-w-0 ms-4">
									<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
										Apple iPhone 15 Pro Max
									</p>
									<p class="text-sm text-gray-500 truncate dark:text-gray-400">
										Quantity: 1
									</p>
								</div>
								<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
									$320
								</div>
							</div>
						</li>
						<li class="py-3 sm:py-4">
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<img alt="Neil image" class="w-12 h-12 rounded-full" src="https://iplanet.one/cdn/shop/files/iPhone_15_Pro_Max_Blue_Titanium_PDP_Image_Position-1__en-IN_1445x.jpg?v=1695435917">
									</img>
								</div>
								<div class="flex-1 min-w-0 ms-4">
									<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
										Apple iPhone 15 Pro Max
									</p>
									<p class="text-sm text-gray-500 truncate dark:text-gray-400">
										Quantity: 1
									</p>
								</div>
								<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
									$320
								</div>
							</div>
						</li>
						<li class="py-3 sm:py-4">
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<img alt="Neil image" class="w-12 h-12 rounded-full" src="https://iplanet.one/cdn/shop/files/iPhone_15_Pro_Max_Blue_Titanium_PDP_Image_Position-1__en-IN_1445x.jpg?v=1695435917">
									</img>
								</div>
								<div class="flex-1 min-w-0 ms-4">
									<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
										Apple iPhone 15 Pro Max
									</p>
									<p class="text-sm text-gray-500 truncate dark:text-gray-400">
										Quantity: 1
									</p>
								</div>
								<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
									$320
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
</div>