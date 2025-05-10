<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

// Class ini bertanggung jawab untuk memperbarui informasi profil user
class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Fungsi utama untuk memvalidasi dan memperbarui informasi profil user.
     *
     * @param  User  $user  User yang sedang login
     * @param  array<string, string>  $input  Data input dari form profil
     */
    public function update(User $user, array $input): void
    {
        // Melakukan validasi terhadap data input dari pengguna
        Validator::make($input, [
            // Validasi 'name' wajib diisi, berupa string, dan maksimal 255 karakter
            'name' => ['required', 'string', 'max:255'],

            // Validasi 'email' wajib diisi, valid, maksimal 255 karakter, dan unik di tabel users (kecuali milik user yang sedang login)
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Abaikan email milik user saat ini agar tidak dianggap duplikat
            ],
        ])->validateWithBag('updateProfileInformation'); // Simpan error validasi ke dalam "bag" untuk UI

        // Cek apakah email baru berbeda dengan email lama dan user termasuk yang harus memverifikasi email
        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            // Update profil dan reset status verifikasi jika email berubah
            $this->updateVerifiedUser($user, $input);
        } else {
            // Jika email tidak berubah, cukup update nama dan email
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save(); // Simpan perubahan ke database
        }
    }

    /**
     * Fungsi untuk memperbarui profil user yang wajib verifikasi email,
     * sekaligus mengatur ulang status verifikasi jika email diubah.
     *
     * @param  User  $user
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null, // Reset status verifikasi email
        ])->save();

        // Kirim ulang email verifikasi ke alamat email baru
        $user->sendEmailVerificationNotification();
    }
}
