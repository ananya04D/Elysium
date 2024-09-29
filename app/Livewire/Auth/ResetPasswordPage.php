<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Str;

#[Title('Reset Password')]
class ResetPasswordPage extends Component
{
    public $token;
    #[Url]
    public $email;
    public $password;
    public $password_confirmation;

    public function save()
    {
        // Validate the input fields
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);

        // Reset the password
        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        // Check the status and redirect or show error
        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password has been reset successfully!');
            return redirect()->route('login'); // Redirect to the login page
        } else {
            session()->flash('error', 'Something went wrong');
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
