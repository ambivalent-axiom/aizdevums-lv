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
        if (isset($validated['picture']) && $validated['picture'] instanceof UploadedFile) {
            $request->validate(
                ['picture' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048']]
            );
        }
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('pictures', 'public');
            $validated['picture'] = $path;
        }

        $cv = CV::find($validated['id']);
        $user = User::find(Auth::id());

        if ( ! isset($validated['picture']) && $cv->picture)
        {
            $validated['picture'] = $cv->picture;
        }

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
            'picture' => $validated['picture'] ?? null
        ]);

        if(isset($validated['educations']))
        {
            $this->deleteRemovedRelatedRecords($cv, 'educations', $validated['educations']);
            $this->updateOrCreateRelatedRecords($cv, 'education', $validated['educations']);
        }
        if(isset($validated['experiences']))
        {
            $this->deleteRemovedRelatedRecords($cv, 'experiences', $validated['experiences']);
            $this->updateOrCreateRelatedRecords($cv, 'experience', $validated['experiences']);
        }
        if(isset($validated['skills']))
        {
            $this->deleteRemovedRelatedRecords($cv, 'skills', $validated['skills']);
            $this->updateOrCreateRelatedRecords($cv, 'skill', $validated['skills']);
        }
        if(isset($validated['languages']))
        {
            $this->deleteRemovedRelatedRecords($cv, 'languages', $validated['languages']);
            $this->updateOrCreateRelatedRecords($cv, 'language', $validated['languages']);
        }
        if(isset($validated['licenses']))
        {
            $this->deleteRemovedRelatedRecords($cv, 'licenses', $validated['licenses']);
            $this->updateOrCreateRelatedRecords($cv, 'license', $validated['licenses']);
        }
        return redirect('cv')->with('success', 'CV record updated!');
    }

    private function updateOrCreateRelatedRecords(CV $cv, string $relation, array $data): void
    {
        foreach ($data as $item) {
            $modelClass = 'App\\Models\\' . ucfirst($relation);
            $modelClass::updateOrCreate(
                [
                    'cv_id' => $cv->id,
                    'id' => $item[$relation . 's_id'] ?? null,
                ],
                $item
            );
        }
    }
    private function deleteRemovedRelatedRecords(CV $cv, string $relation, array $data,): void
    {

        $ids = [];
        $collection = $cv->{$relation};
        foreach ($data as $item) {
            if (isset($item[$relation . '_id']))
            {
                $ids[] = $item[$relation . '_id'];
            }
        }
        foreach ($collection as $item) {
            if ( ! in_array($item->id, $ids)) {
                $item->delete();
            }
        }
    }
}
