<?php

namespace App\Http\Controllers\CV;

use App\Http\Controllers\Controller;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CvIndexShowController extends Controller
{
    public function index(): View
    {
        $cvs = CV::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('cv.index', [
            'cvs' => $cvs
        ]);
    }
    public function show(CV $cv): View
    {
        return view('cv.show', [
            'cv' => $cv
        ]);
    }
}
