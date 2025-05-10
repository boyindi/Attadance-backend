<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

// Trait ini berisi aturan validasi password untuk digunakan di bagian lain aplikasi
trait PasswordValidationRules
{
    /**
     * Fungsi untuk mendapatkan aturan validasi password.
     *
     * Aturan yang digunakan:
     * - 'required': password wajib diisi
     * - 'string': harus berupa string
     * - Password::default(): menggunakan aturan bawaan Laravel (panjang minimal 8 karakter, dll.)
     * - 'confirmed': harus cocok dengan field konfirmasi (misalnya password_confirmation)
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }
}
