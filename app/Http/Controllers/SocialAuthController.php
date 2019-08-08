<?php
namespace App\Http\Controllers;

use App\SocialiteHandler;
use Socialite;

class SocialAuthController extends Controller
{
    /**
     * Create a redirect method to twitter api.
     *
     * @return void
     */
    public function redirect($provider)
    {

        
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    
    public function callback($provider, SocialiteHandler $service)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);
        auth()->login($user);
        return redirect()->to('/home');
    }
}
