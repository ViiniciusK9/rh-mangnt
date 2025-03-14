<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhManagementController extends Controller
{
    public function index()
    {
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access this page');

        $collaborators = User::withTrashed()
            ->with('detail', 'department')
            ->where('role', 'collaborator')
            ->get();

        return view('rh.management.index', compact('collaborators'));
    }

}
