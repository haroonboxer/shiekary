<?php

namespace App\Http\Controllers\Api;

use App\Models\License;
use App\Models\President;
use App\Models\Organization;
use App\Models\VicePresident;
use App\Http\Controllers\Controller;

class LicenseController extends Controller
{
    public function checkLicenseByQRCode(string $qrCode)
    {
        $typeId = (int) last(explode('-', $qrCode));

        $license = License::where('type_id', $typeId)->firstOrFail();

        $organization = Organization::where('id', $license->organization_id)
            ->select('id', 'name_en', 'name_dr', 'logo', 'type')
            ->first();

        $president = President::where([
            'status' => 1,
            'organization_id' => $license->organization_id,
        ])
            ->orderByDesc('id')
            ->select('name_dr', 'name_en', 'last_name_dr', 'last_name_en', 'image')
            ->first();

        $vicePresident = VicePresident::where([
            'status' => 1,
            'organization_id' => $license->organization_id,
        ])
            ->orderByDesc('id')
            ->select('name_dr', 'name_en', 'last_name_dr', 'last_name_en', 'image')
            ->first();

        return response()->json([
            'license' => $license,
            'organization' => $organization,
            'president' => $president,
            'vice_president' => $vicePresident,
        ]);
    }
}
