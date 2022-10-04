<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\TuChance\Models\Partner;

class PartnersController extends Controller
{
    /**
     * All countries.
     * @param  \App\TuChance\Models\Partner $partners
     * @return void
     */
    public function index(Partner $partners)
    {
        $rows = $partners->with('image')
            ->has('image')
            ->where('is_active', 1)
            ->get();
        return PartnerResource::collection($rows);
    }
}
