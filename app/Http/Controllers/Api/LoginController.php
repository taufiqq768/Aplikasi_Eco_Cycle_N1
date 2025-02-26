<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

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
                    if ($localUser->kode_unit !== $apiUser['PERSONNEL_SUB_AREA']) {
                        $localUser->update([
                            'kode_unit' => $apiUser['PERSONNEL_SUB_AREA'],
                        ]);
                    }
                    if ($localUser->nama !== $apiUser['NAMA']) {
                        $localUser->update([
                            'nama' => $apiUser['NAMA'],
                        ]);
                    }
                    $token = $localUser->createToken('auth_token')->plainTextToken;
                    $localUser->token = $token; // Add token to user object
                    $localUser->nik_sap = (string) $localUser->nik_sap;
                    return response()->json([
                        'error' => false,
                        'message' => 'Login success',
                        'data' => array_merge($localUser->toArray(), [
                            'nik_sap' => (string) $localUser->nik_sap,
                        ]),
                    ]);
                } else {
                    return response()->json([
                        'error' => true,
                        'message' => 'Akun Belum Aktif',
                    ]);
                }
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Username atau Password Salah',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Server Error',
            ]);
        }
    }
}
