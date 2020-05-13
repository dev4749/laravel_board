<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        /*
         * 직접 Policy모델을 등록하는 대신에, 라라벨은 모델과 Policy이 표준 라라벨 네이밍 규칙을 따른다면
         * auto-discover Policy을 사용할 수 있습니다.
         * 분명하게, Policy는 models-모델을 포함하는 디렉토리의 아래로 Policies 디렉토리를 위치해야합니다.
         * 예를들어, models-모델은 app 디렉토리 아래에 위치한다면, Policy 는 app/Policies 디렉토리에 위치할 수 있습니다.
         * 또한, Policy 이름은 model-모델 이름과 매칭되어야되며, Policy 접미사를 써야합니다.
         * 예를들어, 모델 이름이 User 이라면 Policy는 UserPolicy 클래스의 이름으로 이용하면 됩니다.
         */
//        \App\Post::class => \App\Policies\PostPolicy::class,
//        \App\Comment::class => \App\Policies\CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
