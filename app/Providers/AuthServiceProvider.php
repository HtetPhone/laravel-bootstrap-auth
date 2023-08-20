<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate::define('article-update', function(User $user, Article $article) {
        //     return  $user->id == $article->author_id;
        // });

        // Gate::define('article-delete', function(User $user, Article $article) {
        //     return $user->id == $article->author_id ?
        //     Response::allow():
        //     Response::deny("Wrong access") ;
        // } );

        //admin access
        // Gate::before( function(User $user) {
        //     if($user->id == 11) {
        //         return true;
        //     }
        // });

        //what if we have multiple admins
        // Gate::before( function(User $user) {
        //     $admins = [1,7,11,8];
        //     if(in_array($user->id, $admins)) {
        //         return true;
        //     }
        // });


        // Gate::define('show-user-list', function(User $user) {
        //     return $user->role === 'admin';
        // });

        Gate::define('admin-only', fn(User $user) => $user->role === 'admin');
    }
}
