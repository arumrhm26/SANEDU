<?php

namespace App\Livewire\User;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.user')]
class Pengaturan extends Component
{

    use WithRateLimiting;

    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->addError('limit', "Anda terlalu sering mengirimkan permintaan. Silakan coba lagi nanti setelah {$exception->secondsUntilAvailable} detik.");
            return;
        } catch (\Throwable $th) {

            $this->email = Auth::user()->email;
            $this->name = Auth::user()->name;
            Toaster::error('Profile update failed');
            return;
        }

        /** @var User */
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);


        $user->fill($validated);
        $user->save();


        Toaster::success('Profile updated successfully');
    }


    public function sendVerification(): void
    {

        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->addError('limit', "Anda terlalu sering mengirimkan permintaan. Silakan coba lagi nanti setelah {$exception->secondsUntilAvailable} detik.");
            return;
        }

        /** @var User */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }



        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.user.pengaturan');
    }
}
