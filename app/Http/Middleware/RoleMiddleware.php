<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Role hierarchy: higher number = more privileges.
     * admin can access everything employee & user can.
     * employee can access everything user can.
     */
    protected array $hierarchy = [
        'user'     => 1,
        'employee' => 2,
        'admin'    => 3,
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user       = Auth::user();
        $userRole   = $user->role;
        $userLevel  = $this->hierarchy[$userRole] ?? 0;
        $routeName  = $request->route()?->getName() ?? '';

        // What minimum level does this route need?
        $requiredLevel = $this->requiredLevel($routeName);

        // Route not role-protected → let it through
        if ($requiredLevel === null) {
            return $next($request);
        }

        // User level meets/exceeds requirement → allowed
        if ($userLevel >= $requiredLevel) {
            return $next($request);
        }

        // Otherwise → redirect to the user's own highest dashboard
        return $this->redirectToOwnDashboard($userRole, $routeName);
    }

    /**
     * Map a route name to the minimum role level needed.
     * Returns null if the route is not role-restricted.
     */
    protected function requiredLevel(string $routeName): ?int
    {
        if (str_starts_with($routeName, 'admin')) {
            return $this->hierarchy['admin'];      // 3
        }
        if (str_starts_with($routeName, 'employee')) {
            return $this->hierarchy['employee'];   // 2
        }
        if ($routeName === 'dashboard') {
            return $this->hierarchy['user'];       // 1
        }

        return null;
    }

    /**
     * Send the user to their own highest-priority dashboard.
     * Aborts with 403 if that would loop.
     */
    protected function redirectToOwnDashboard(string $userRole, string $routeName): Response
    {
        $ownRoute = match ($userRole) {
            'admin'    => 'admin.dashboard',
            'employee' => 'employee.dashboard',
            'user'     => 'dashboard',
            default    => null,
        };

        // Unknown role, or already on own dashboard → no safe redirect
        if ($ownRoute === null || $routeName === $ownRoute) {
            abort(403, 'Unauthorized access');
        }

        return redirect()->route($ownRoute);
    }
}