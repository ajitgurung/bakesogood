<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToEditSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin/settings') || $request->is('admin/settings/create')) {
            $setting = Setting::firstOrFail();
            return redirect()->route('filament.admin.resources.settings.edit', ['record' => $setting->id]);
        }
        return $next($request);
    }
}
