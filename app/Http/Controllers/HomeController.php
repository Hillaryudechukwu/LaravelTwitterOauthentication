<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Requests\createSearchValidation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $connection;
    public $search;
    public $trendingTweent;
    public $currentFeed;
    private $twitLoginApi;

    public function __construct()
    {

        $twitLoginApi = \config('TwitterApiDetails.twitterApi');
        $client_id = $twitLoginApi['client_id'];
        $client_secret = $twitLoginApi['client_secret'];
        $access_token = $twitLoginApi['access_token'];
        $access_token_secret = $twitLoginApi['access_token_secret'];
        $this->connection = new TwitterOAuth($client_id, $client_secret, $access_token, $access_token_secret);

        $this->middleware('auth');
        $trendingTweent = $this->trendingTweent;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    

    /**
     * This method twitterList is used to load
     * the list on twitter though not implemented
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function twitterList()
    {

        $followers = $this->connection->get('followers/list');

        return view('home')->with('followers', $followers);
    }

    /**
     * This method TimeLine is used to load
     * the most recent tweent on twitter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function TimeLine()
    {
        $content = $this->connection->get("account/verify_credentials");
        $statuses = $this->connection->get("statuses/home_timeline", array("count" => 10, "exclude_replies" => true));
        return $statuses;

    }
    /**
     * The method searchFeed is used for searching  purposes
     * on twitter
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function searchFeed(createSearchValidation $request)
    {

        $this->search = $request->get('search');
        $query = array("q" => $this->search, "count" => 15, "result_type" => "recent");
        $tweets = $this->connection->get('search/tweets', $query);

        return view('home', ['statuses' => $this->TimeLine(), 'tweets' => $tweets]);

    }

}
