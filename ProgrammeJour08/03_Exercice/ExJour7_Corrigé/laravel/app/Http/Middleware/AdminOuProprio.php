<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Voiture;

class AdminOuProprio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $proprietaireVoiture = Voiture::find($request->voiture)->user_id;
        if ($request->user()->admin || $request->user()->id == $proprietaireVoiture) {
            return $next($request);
        }
        return new RedirectResponse(url('voitures'));
    }
}

