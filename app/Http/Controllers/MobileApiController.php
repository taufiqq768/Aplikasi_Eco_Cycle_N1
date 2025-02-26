<?php

namespace App\Http\Controllers;

use App\Models\MasterRegion;
use Illuminate\Http\Request;

class MobileApiController extends Controller
{
    public function getRegion()
    {
        $regions = MasterRegion::where('is_active', true)->get();

        return response()->json([
            'error' => false,
            'message' => 'Data Region',
            'data' => $regions,
        ]);
    }
}
