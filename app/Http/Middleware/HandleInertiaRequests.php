<?php

namespace App\Http\Middleware;

use App\Models\Cfc;
use App\Models\Clinica;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $cfc_selecionado = null;
        $permissions = null;
        $roles = null;
        $cfcs = null;
        
        if(isset(auth()->user()->cfc_selecionado))
            $cfc_selecionado = auth()->user()->cfc_selecionado;
  

        if (Auth::check())
        {
            if(auth()->user()->cfcs && !auth()->user()->hasRole('Admin')){
                $cfcs = auth()->user()->cfcs;
            }else{
                $cfcs = Cfc::all();
            }

            $permissions = auth()->user()->getAllPermissions();
            $roles = auth()->user()->roles;
        }

        return array_merge(parent::share($request), [
            'auth' =>[
                'cfc_selecionado' => Cfc::where('id', $cfc_selecionado)->first('nome'),
            ],
            'auth.user.permissions' => $permissions,
            'auth.user.roles' => $roles,
            'auth.user.cfcs' => $cfcs,
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error')
                ];
            }
        ]);
    }
}
