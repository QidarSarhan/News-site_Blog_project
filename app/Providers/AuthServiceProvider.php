<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }

	/**
	 * The model to policy mappings for the application.
	 * 
	 * @return array<class-string, class-string>
	 */
	public function getPolicies() {
		return $this->policies;
	}
	
	/**
	 * The model to policy mappings for the application.
	 * 
	 * @param array<class-string, class-string> $policies The model to policy mappings for the application.
	 * @return self
	 */
	public function setPolicies($policies): self {
		$this->policies = $policies;
		return $this;
	}
}
