<?php

namespace App\Livewire\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Quên mật khẩu - ShopWise')]
class ForgotPasswordPage extends Component
{
    use LivewireAlert;
    public $email;

    public function save()
    {
        $request = new ForgotPasswordRequest();
        $validationData = $request->livewireRules();

        $this->validate([
            'email' => $validationData['rules']['email']
        ], $validationData['messages']);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->alert('success', 'Liên kết đặt lại mật khẩu đã được gửi đến địa chỉ email', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
               ]);
            $this->email = '';
        }


    }
    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
