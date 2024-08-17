<?php

namespace App\Http\Controllers\CV;

use App\Http\Controllers\Controller;
use App\Http\Requests\CvCreateUpdateRequest;
use App\Models\CV;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class CvCreateController extends Controller
{
    public function create(): View
    {
        return view('cv.create');
    }
    public function store(CvCreateUpdateRequest $request): RedirectResponse
    {
        $user = User::find(Auth::id());
        $validated = $request->validated();
        if ($request->picture instanceof UploadedFile) {
            $request->validate(
                ['picture' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']]
            );
        }
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('pictures', 'public');
            $validated['picture'] = $path;
        } else {
            $validated['picture'] = null;
        }

        $cv = CV::create([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'picture' => $validated['picture'],
        ]);

        $cv->educations()->createMany($validated['educations']);
        $cv->experiences()->createMany($validated['experiences']);
        $cv->languages()->createMany($validated['languages']);
        $cv->licenses()->createMany($validated['licenses']);
        $cv->skills()->createMany($validated['skills']);

        return redirect('cv')->with('success', 'CV record created!');
    }
}
