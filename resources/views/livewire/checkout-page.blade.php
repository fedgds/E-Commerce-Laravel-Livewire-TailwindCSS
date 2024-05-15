<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
	<section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg p-4">
		<h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Thanh toán</h1>
		<form wire:submit.prevent='placeOrder'>
			<div class="grid grid-cols-12 gap-4">
				<div class="md:col-span-12 lg:col-span-8 col-span-12">
					<!-- Card -->
					<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
						<!-- Shipping Address -->
						<div class="mb-6">
							<h2 class="text-2xl font-bold text-black dark:text-white mb-2">
								Thông tin nhận hàng
							</h2>
							<div class="mt-4">
								<label class="block text-gray-700 dark:text-white mb-1" for="first_name">
									Họ và Tên
								</label>
								<input wire:model='full_name' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="first_name" type="text" placeholder="Nhập họ và tên"></input>
								@error('full_name')
									<p class="text-xs text-red-600 mt-2">{{ $message }}</p>
								@enderror
							</div>
							<div class="mt-4">
								<label class="block text-gray-700 dark:text-white mb-1" for="phone">
									Số điện thoại
								</label>
								<input wire:model='phone' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" type="text" placeholder="Nhập số điện thoại"></input>
								@error('phone')
									<p class="text-xs text-red-600 mt-2">{{ $message }}</p>
								@enderror
							</div>
							{{-- <div class="grid grid-cols-2 gap-4">
								<div>
									<label class="block text-gray-700 dark:text-white mb-1" for="city">
										Thành phố
									</label>
									<input wire:model='city' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="city" type="text"></input>
								</div>
								<div>
									<label class="block text-gray-700 dark:text-white mb-1" for="address">
										Quận/Huyện
									</label>
									<input wire:model='district' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="address" type="text"></input>
								</div>
							</div> --}}
							<div class="grid grid-cols-2 gap-4 mt-4">
								<div>
									<label class="block text-gray-700 dark:text-white mb-1" for="city">
										Thành phố
									</label>
									<select wire:model='city' class="form-select city w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="city" onchange="loadDistrict()">
										<option selected>Chọn thành phố</option>
									</select>
									@error('city')
										<p class="text-xs text-red-600 mt-2">{{ $message }}</p>
									@enderror
								</div>
								<div>
									<label class="block text-gray-700 dark:text-white mb-1" for="district">
										Quận/Huyện
									</label>
									<select wire:model='district' class="form-select district w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="district">
										<option selected>Chọn quận huyện</option>
									</select>
									@error('district')
										<p class="text-xs text-red-600 mt-2">{{ $message }}</p>
									@enderror
								</div>
							</div>
							<div class="mt-4">
								<label class="block text-gray-700 dark:text-white mb-1" for="phone">
									Địa chỉ
								</label>
								<input wire:model='address' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" type="text" placeholder="Nhập địa chỉ"></input>
								@error('address')
									<p class="text-xs text-red-600 mt-2">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="text-lg font-semibold mb-4">
							Chọn phương thức thanh toán
						</div>
						<ul class="grid w-full gap-6 md:grid-cols-2">
							<li>
								<input wire:model='payment_method' value="cod" class="hidden peer" id="hosting-big" type="radio">
								<label class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
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
							<li>
								<input wire:model='payment_method' value="momo" class="hidden peer" id="hosting-small" type="radio"/>
								<label class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-rose-500 peer-checked:border-rose-600 peer-checked:text-rose-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
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
						</ul>
						@error('payment_method')
							<p class="text-xs text-red-600 mt-2">{{ $message }}</p>
						@enderror
					</div>
					<!-- End Card -->
				</div>
				<div class="md:col-span-12 lg:col-span-4 col-span-12">
					<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
						<div class="text-2xl font-bold text-black dark:text-white mb-2">
							Tóm tắt đơn hàng
						</div>
						<div class="flex justify-between mb-2 font-bold">
							<span>
								Tổng tiền
							</span>
							<span>
								{{ number_format($grand_total) }} đ
							</span>
						</div>
						<div class="flex justify-between mb-2 font-bold">
							<span>
								Thuế
							</span>
							<span>
								0 đ
							</span>
						</div>
						<div class="flex justify-between mb-2 font-bold">
							<span>
								Phí giao hàng
							</span>
							<span>
								0 đ
							</span>
						</div>
						<hr class="bg-slate-400 my-4 h-1 rounded">
						<div class="flex justify-between mb-2 font-bold">
							<span>
								Tổng cộng
							</span>
							<span>
								{{ number_format($grand_total) }} đ
							</span>
						</div>
						</hr>
					</div>
					<button type="submit" class="bg-gray-900 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-gray-800">
						Đặt hàng
					</button>
					<div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
						<div class="text-xl font-bold text-black dark:text-white mb-2">
							Giỏ hàng
						</div>
						<ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
							@foreach ($cart_items as $item)
								<li class="py-3 sm:py-4" wire:key='{{ $item['product_id'] }}'>
									<div class="flex items-center">
										<div class="flex-shrink-0">
											<img alt="Neil image" class="w-12 h-12 rounded-full" src="{{ url('storage', $item['image']) }}"></img>
										</div>
										<div class="flex-1 min-w-0 ms-4">
											<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
												{{ $item['name'] }}
											</p>
											<p class="text-sm text-gray-500 truncate dark:text-gray-400">
												Số lượng: {{ $item['quantity'] }}
											</p>
										</div>
										<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
											{{ number_format($item['total_amount']) }} đ
										</div>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</form>
	</section>
	<script>
        var config = {
			cUrl: 'https://api.countrystatecity.in/v1/countries',
			ckey: 'WjBGY1llamo2U1d2cTlDSXdrQzk3QU9YWXZjVmhlckpDc2owSWhENw=='
		}


		var stateSelect = document.querySelector('.city'),
			citySelect = document.querySelector('.district')


		function loadCities() {
			stateSelect.disabled = false
			citySelect.disabled = true
			stateSelect.style.pointerEvents = 'auto'
			citySelect.style.pointerEvents = 'none'
		
			const selectedCountryCode = 'VN'; // Chỉ định mã quốc gia của Việt Nam
		
			fetch(`${config.cUrl}/${selectedCountryCode}/states`, {headers: {"X-CSCAPI-KEY": config.ckey}})
			.then(response => response.json())
			.then(data => {
		
				data.forEach(state => {
					const option = document.createElement('option')
					option.value = state.iso2
					option.textContent = state.name 
					stateSelect.appendChild(option)
				})
			})
			.catch(error => console.error('Error loading states:', error))
		}
		
		function loadDistrict() {
			citySelect.disabled = false
			citySelect.style.pointerEvents = 'auto'
		
			const selectedCountryCode = 'VN';
			const selectedStateCode = stateSelect.value
		
			citySelect.innerHTML = '<option value="">Chọn quận huyện</option>'
		
			fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {headers: {"X-CSCAPI-KEY": config.ckey}})
			.then(response => response.json())
			.then(data => {
		
				data.forEach(city => {
					const option = document.createElement('option')
					option.value = city.iso2
					option.textContent = city.name 
					citySelect.appendChild(option)
				})
			})
			.catch(error => console.error('Error loading cities:', error))
		}
    

	window.onload = loadCities
    </script>
</div>