<?php

namespace App\Http\Controllers\CV;

use App\Http\Controllers\Controller;
use App\Models\CV;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvDestroyController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:cv,id'],
        ]);
        $cv = CV::find($validated['id']);

        if ($cv->user_id != Auth::id()) {
            return redirect('cv')->with('error', 'Unauthorized action.');
        }

        if ($cv->experiences)
        {
            foreach ($cv->experiences as $experience)
            {
                $experience->delete();
            }
        }
        if ($cv->educations)
        {
            foreach ($cv->educations as $education)
            {
                $education->delete();
            }
        }
        if ($cv->skills)
        {
            foreach ($cv->skills as $skill)
            {
                $skill->delete();
            }
        }
        if ($cv->licenses)
        {
            foreach ($cv->licenses as $license)
            {
                $license->delete();
            }
        }
        if ($cv->languages)
        {
            foreach ($cv->languages as $language)
            {
                $language->delete();
            }
        }
        $cv->delete();
        return redirect('cv')->with('success', 'CV has been deleted.');
    }
}
