<?php

namespace App\Http\Controllers;

use App\Models\ReleaseNote;
use Illuminate\Http\Request;

class ReleaseNoteController extends Controller
{
    public function index()
    {
        $releaseNotes = ReleaseNote::orderBy('created_at', 'desc')->get();
        return view('release_notes', compact('releaseNotes'));
    }
}
