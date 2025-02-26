<?php

namespace App\Livewire;

use App\Models\User;
use Hash;
use Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Request;

class Login extends Component
{
    #[Layout("layouts.guest")]
    public function render()
    {
        return view('livewire.login');
    }

    public $username;
    public $password;
    public $username_mobile;
    public $password_mobile;


    public function formSubmit()
    {
        $validated = $this->validate([
            'username' => 'required|min:5',
            'password' => 'required',
        ]);

        $this->auth($validated['username'], $validated['password']);
    }

    public function formSubmitMobile()
    {
        $validated = $this->validate([
            'username_mobile' => 'required|min:5',
            'password_mobile' => 'required',
        ]);

        $this->auth($validated['username_mobile'], $validated['password_mobile']);
    }

    public function auth($username, $password)
    {
        $this->js("$('#borderedToast4').toast('show');");
        // if ($username == '19002851' && $password == '123') {
        //     $localUser = User::where('nik_sap', $username)->first();
        //     Auth::login($localUser);
        //     return $this->redirectRoute('dashboard.index');
        // }

        $res = Http::withoutVerifying()->acceptJson()->get(
            'https://apis.holding-perkebunan.com/access/login',
            [
                'niksap' => $username,
                'password' => $password,
                'status-login' => 1
            ]
        );
        if ($res->successful()) {
            if ($res->json()[0]["NAMA"]) {
                $apiUser = $res->json()[0];
                $localUser = User::where('nik_sap', $apiUser['NIK_SAP'])->first();
                if ($localUser) {
                    if ($localUser->kode_unit !== $apiUser['PSA_SAP']) {
                        $localUser->update([
                            'kode_unit' => $apiUser['PSA_SAP'],
                        ]);
                    }
                    if ($localUser->nama !== $apiUser['NAMA']) {
                        $localUser->update([
                            'nama' => $apiUser['NAMA'],
                        ]);
                    }
                    Auth::login($localUser);
                    $this->redirectRoute('dashboard.index');
                } else {
                    throw ValidationException::withMessages([
                        'username' => __('Akun Anda Belum Aktif'),
                    ]);
                }
            } else {
                throw ValidationException::withMessages([
                    'username' => __('Username dan Password Anda Salah'),
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'username' => __('Ada Masalah Pada Server'),
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
