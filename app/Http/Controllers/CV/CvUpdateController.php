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

class CvUpdateController extends Controller
{
    public function update(CV $cv): View
    {
        return view('cv.update', [
            'cv' => $cv
        ]);
    }
    public function patch(CvCreateUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if ($validated['picture'] instanceof UploadedFile) {
            $request->validate(
                ['picture' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']]
            );
        }
        if (is_string($validated['picture'])) {
            $request->validate(
                ['picture' => ['nullable', 'string']]
            );
        }
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('pictures', 'public');
            $validated['picture'] = $path;
        }

        $cv = CV::find($validated['id']);
        $user = User::find(Auth::id());

        if ($cv->user_id != Auth::id()) {
            return redirect('cv')->with('error', 'CV not found!');
        }

        $cv->update([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'picture' => $validated['picture']
        ]);

        $this->updateOrCreateRelatedRecords($cv, 'educations', $validated['educations']);
        $this->updateOrCreateRelatedRecords($cv, 'experiences', $validated['experiences']);
        $this->updateOrCreateRelatedRecords($cv, 'languages', $validated['languages']);
        $this->updateOrCreateRelatedRecords($cv, 'licenses', $validated['licenses']);
        $this->updateOrCreateRelatedRecords($cv, 'skills', $validated['skills']);

        return redirect('cv')->with('success', 'CV record updated!');
    }

    private function updateOrCreateRelatedRecords($cv, $relation, $data): void
    {
        foreach ($data as $item) {
            $modelClass = 'App\\Models\\' . ucfirst(rtrim($relation, 's'));
            $modelClass::updateOrCreate(
                ['cv_id' => $cv->id, 'id' => $item['id'] ?? null],
                $item
            );
        }
    }
}
