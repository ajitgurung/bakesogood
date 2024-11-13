<?php

namespace App\Http\Middleware;

use App\Models\About;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToEditAbout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin/abouts') || $request->is('admin/abouts/create')) {
            $about = About::firstOrFail();
            return redirect()->route('filament.admin.resources.abouts.edit', ['record' => $about->id]);
        }
        return $next($request);
    }
}
