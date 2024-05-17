<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg p-4">
        <h1 style="font-family: cursive" class="text-center mb-5 text-5xl text-rose-600">Tài khoản</h1>
        <form wire:submit.prevent='updateInfomation'>
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <h2 class="text-2xl font-bold text-black dark:text-white mb-2">
                    Chỉnh sửa thông tin
                </h2>
                <div class="mt-4">
                    <label class="block text-gray-700 dark:text-white mb-1" for="name">
                        Tên tài khoản
                    </label>
                    <input wire:model='name' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="name" type="text" placeholder="Nhập họ và tên"></input>
                    @error('name')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 dark:text-white mb-1" for="email">
                        Email
                    </label>
                    <input wire:model='email' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="email" type="text" placeholder="Nhập email"></input>
                    @error('email')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 dark:text-white mb-1" for="password">
                        Mật khẩu
                    </label>
                    <input wire:model='password' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="password" type="password" placeholder="Nhập mật khẩu"></input>
                    @error('password')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-gray-900 mt-4 px-3 py-2 rounded-lg text-sm text-white hover:bg-gray-800">
                    Cập nhật
                </button>
            </div>
        </form>
    </section>
</div>
