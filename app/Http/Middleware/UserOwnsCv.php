<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserOwnsCv
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cvId = $request->route('cv')->id ?? $request->id;
        if ( ! $this->cvBelongsToUser($cvId)) {
            return redirect()->back()->with('error', 'Unable to locate CV.');
        }
        return $next($request);
    }
    protected function cvBelongsToUser(int $cvId): bool
    {
        $cvs = Auth::user()->cvs;
        return $cvs->contains($cvId);
    }
}
