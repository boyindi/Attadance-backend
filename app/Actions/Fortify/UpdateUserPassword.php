<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

// Class ini menangani proses validasi dan pembaruan password user
class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Fungsi untuk memvalidasi dan memperbarui password pengguna.
     *
     * @param  User  $user  Pengguna yang ingin diperbarui password-nya
     * @param  array<string, string>  $input  Data input dari form
     */
    public function update(User $user, array $input): void
    {
    //    lakukan validasi terhadap input pengguna
        Validator::make($input, [
            // Password lama harus diisi dan cocok dengan password di database
            'current_password' => ['required', 'string', 'current_password:web'],

            // Password baru divalidasi
            'password' => $this->passwordRules(),
        ], [
            // Pesan error khusus jika password lama tidak cocok
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validateWithBag('updatePassword'); // Menyimpan validasi

        // Jika validasi berhasil, update password pengguna
        $user->forceFill([
            // Password baru di-hash sebelum disimpan
            'password' => Hash::make($input['password']),
        ])->save(); // Simpan perubahan ke database
    }
}
