<?php

namespace App\Http\Middleware;

use App\Models\Branch;
use App\Models\Setting;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Menus\GetSidebarMenu;
use App\Models\Menulist;
use App\Models\RoleHierarchy;

class GetMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::getLocale() == null) {
            app()->setLocale('en');
            session()->put('language', 'en');
        }
        if (Auth::check()) {
            $role = 'guest';
            //$role =  Auth::user()->menuroles;
            $userRoles = Auth::user()->getRoleNames();
            //$userRoles = $userRoles['items'];
            $roleHierarchy = RoleHierarchy::select('role_hierarchy.role_id', 'roles.name')
            ->join('roles', 'roles.id', '=', 'role_hierarchy.role_id')
            ->orderBy('role_hierarchy.hierarchy', 'asc')->get();
            $flag = false;
            foreach ($roleHierarchy as $roleHier) {
                foreach ($userRoles as $userRole) {
                    if ($userRole == $roleHier['name']) {
                        $role = $userRole;
                        $flag = true;
                        break;
                    }
                }
                if ($flag === true) {
                    break;
                }
            }
        } else {
            $role = 'guest';
        }
        //session(['prime_user_role' => $role]);
        $menus = new GetSidebarMenu();
        $menulists = Menulist::all();
        $result = array();
        foreach ($menulists as $menulist) {
            $result[ $menulist->name ] = $menus->get($role, $menulist->id);
        }
        view()->share('appMenus', $result);
        $branch_guest = Branch::where('company_id', 1)->take(2)->get();
        view()->share('branch_guest', $branch_guest);
        $setting = Setting::all()->first();
        view()->share('setting', $setting);
        if (strpos($request->url(), 'admin') > -1 && !isset(Auth::user()->username)) {
            return redirect()->route('login');
        }
        if (strpos($request->url(), 'admin') > -1 && isset(Auth::user()->username) && App::getLocale() == 'en') {
            app()->setLocale('vi');
            session()->put('language', 'vi');
        }
        return $next($request);
    }
}
