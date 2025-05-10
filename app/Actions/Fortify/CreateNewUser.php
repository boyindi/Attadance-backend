<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

// Class ini digunakan untuk membuat user baru saat proses registrasi
class CreateNewUser implements CreatesNewUsers
{

    use PasswordValidationRules;

    /**
     * validasi untuk membuat user baru
     *
     * @param  array<string, string>  $input
     * @return User
     */
    public function create(array $input): User
    {
        // Melakukan validasi terhadap input pengguna
        Validator::make($input, [
            // Validasi bahwa 'name'  string, dan maksimal 255 karakter
            'name' => ['required', 'string', 'max:255'],

            // Validasi  'email'harus valid, dan unik di tabel users
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],

            // Validasi password benar atau tidak
            'password' => $this->passwordRules(),
        ])->validate();

        // Menyimpan user baru ke database jika validasi lolos
        return User::create([
            'name' => $input['name'], // simpan nama pengguna
            'email' => $input['email'], // simpan email
            'password' => Hash::make($input['password']), // Enkripsi password sebelum disimpan
        ]);
    }
}
