<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // ── PENGURUS INTI ────────────────────────────────────────────────
            [
                'name'    => 'Quratu Ayun Defaren',
                'email'   => 'ketua@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'ketua_hmse',
                'nim_nip' => '103122400064',
                'divisi'  => 'Pimpinan',
            ],
            [
                'name'    => 'Muhammad Rasyid Ridho',
                'email'   => 'wakilketua@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'wakil_ketua_hmse',
                'nim_nip' => '103122400018',
                'divisi'  => 'Pimpinan',
            ],
            [
                'name'    => 'Siti Nurhaliza',
                'email'   => 'sekretaris@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'sekretaris',
                'nim_nip' => '103122400021',
                'divisi'  => 'Sekretaris',
            ],
            [
                'name'    => 'Budi Santoso',
                'email'   => 'bendahara@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'bendahara',
                'nim_nip' => '103122400033',
                'divisi'  => 'Bendahara',
            ],
            // ── HEAD DIVISI ──────────────────────────────────────────────────
            [
                'name'    => 'Ahmad Fauzi',
                'email'   => 'head.akademik@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'ketua_panitia',
                'nim_nip' => '103122400045',
                'divisi'  => 'Head of Research and Creativity',
            ],
            [
                'name'    => 'Dian Permatasari',
                'email'   => 'head.eksternal@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'head_divisi',
                'nim_nip' => '103122400052',
                'divisi'  => 'Head of Internal and External Communication',
            ],
            [
                'name'    => 'Fajar Nugroho',
                'email'   => 'head.mikat@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'head_divisi',
                'nim_nip' => '103122400060',
                'divisi'  => 'Head of Economy Creative',
            ],
            [
                'name'    => 'Hana Safitri',
                'email'   => 'head.wirausaha@hmse.ac.id',
                'password'=> Hash::make('hmse2026'),
                'role'    => 'pengurus',
                'jabatan' => 'head_divisi',
                'nim_nip' => '103122400072',
                'divisi'  => 'Head of Creative Media and Information',
            ],
            // ── PEMBINA & KAPRODI ────────────────────────────────────────────
            [
                'name'    => 'Yudha Islami Sulistya, S.Kom., M.Cs',
                'email'   => 'pembina@ittelkom-pwt.ac.id',
                'password'=> Hash::make('pembina2026'),
                'role'    => 'pembina',
                'jabatan' => 'pembina',
                'nim_nip' => '0609020001',
                'divisi'  => 'Pembina HMSE',
            ],
            [
                'name'    => 'Abednego Dwi Septiadi, S.Kom., M.Kom',
                'email'   => 'kaprodi@ittelkom-pwt.ac.id',
                'password'=> Hash::make('pembina2026'),
                'role'    => 'pembina',
                'jabatan' => 'kaprodi',
                'nim_nip' => '22890018',
                'divisi'  => 'Kaprodi RPL',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                array_merge($user, [
                    'email_verified_at' => now(),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ])
            );
        }
    }
}
