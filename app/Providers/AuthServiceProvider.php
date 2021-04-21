<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
<<<<<<< HEAD
use Laravel\Passport\Passport;
=======
>>>>>>> first commit

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
<<<<<<< HEAD
        // 'App\Model' => 'App\Policies\ModelPolicy',
=======
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
>>>>>>> first commit
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

<<<<<<< HEAD
        Passport::routes();
=======
        //
>>>>>>> first commit
    }
}
