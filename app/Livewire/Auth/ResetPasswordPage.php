<?php

namespace App\Livewire\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Illuminate\Support\Str;
use Livewire\Component;

#[Title('Đặt lại mật khẩu - ShopWise')]
class ResetPasswordPage extends Component
{
    public $token;
    #[Url]
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function save()
    {
        $request = new ResetPasswordRequest();
        $validationData = $request->livewireRules();

        $this->validate([
            'email' => $validationData['rules']['email'],
            'token' => $validationData['rules']['token'],
            'password' => $validationData['rules']['password']
        ], $validationData['messages']);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ],
            function (User $user, string $password){
                $password = $this->password;
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect('/login') : session()->flash('error', 'Lỗi');
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
