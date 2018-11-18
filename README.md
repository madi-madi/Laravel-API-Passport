# Laravel-API-Passport
# -------[Start]-----:)-----

# Steps Laravel API with Passport

1- Install Laravel app . 
2- Install Passport from https://laravel.com/docs/5.7/passport
 # 2.1 $ composer require laravel/passport
 # 2.2 $ php artisan migrate
 # 2.3 $ php artisan passport:install
3- After running this command, add the Laravel\Passport\HasApiTokens 
trait to your  App\User model. This trait will provide a few helper
 methods to your model which allow you to inspect the authenticated user's
  token and scopes:

<?php

namespace App;

# use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  #  use HasApiTokens, Notifiable;
}


4- Next, you should call the Passport::routes method within the boot method of your  AuthServiceProvider. This method will register the routes necessary to issue access tokens and 
revoke access tokens, clients, and personal access tokens:
<?php

namespace App\Providers;

# use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy'.
    ];

    public function boot()
    {
        $this->registerPolicies();

#       Passport::routes();
    }
}


5- Finally, in your config/auth.php configuration file,
you should set the driver option of the  api authentication guard to passport.
This will instruct your application to use Passport's 
TokenGuard when authenticating incoming API requests:

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
 #       'driver' => 'passport',
        'provider' => 'users',
    ],
],


6- to generate passport keys add it in composer.json inside scripts :
https://github.com/madi-madi/Laravel-API-Passport/commit/a1fff1d267671971e539d238efd075c73e540d20
 # "post-install-cmd":[
# "php artisan clear-compiled",
# "chmod -R 777 storage",
# "php artisan passport:keys"
# ],
# -------[End]-----:)-----
 # DEV_ME_BEST_CODER
