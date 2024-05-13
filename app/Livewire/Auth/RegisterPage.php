<?php

namespace App\Livewire\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Đăng ký - ShopWise')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    public function save()
    {
        $request = new RegisterRequest();
        $validationData = $request->livewireRules();

        $this->validate([
            'name' => $validationData['rules']['name'],
            'email' => $validationData['rules']['email'],
            'password' => $validationData['rules']['password']
        ], $validationData['messages']);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        auth()->login($user);

        return redirect()->intended();
    }
    
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
