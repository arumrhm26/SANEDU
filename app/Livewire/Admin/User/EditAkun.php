<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditAkun extends Component
{
    use WithRateLimiting;

    public User $user;

    public string $email = '';
    public string $name = '';

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'name' => 'required|string|max:255',
        ];
    }


    public function updateProfileInformation(): void
    {
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->addError('limit', "Anda terlalu sering mengirimkan permintaan. Silakan coba lagi nanti setelah {$exception->secondsUntilAvailable} detik.");
            return;
        }

        $validated = $this->validate();

        $this->user->fill($validated);

        $this->user->save();

        Toaster::success('Profile updated successfully');
        $this->dispatch('user-updated', name: $this->user->name);
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
        if ($this->user->hasVerifiedEmail()) {
            $this->addError('limit', 'Email sudah terverifikasi');
            return;
        }

        $this->user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function mount(): void
    {
        $this->fill($this->user->toArray());
    }

    public function render()
    {
        return view('livewire.admin.user.edit-akun');
    }
}
