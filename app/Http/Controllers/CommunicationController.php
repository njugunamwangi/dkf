<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Region;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index() {
        $user = auth()->user();
        $region = Region::where('moderator_id', '=', $user->id)->first();

        $members = Member::query()
            ->where('region_id', '=', $region->id)
            ->get();

        return view('communication', compact('members', 'region'));
    }
}
