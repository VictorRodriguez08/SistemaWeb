<?php

namespace sistemaWeb\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'sistemaWeb\Model' => 'sistemaWeb\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
        $gate->before(function($user, $ability) use ($gate){
            if ($user->hasRole("Administrador")) {
                return true;
            }
            return $user->hasAccess([$ability]);
        });
    }
}
