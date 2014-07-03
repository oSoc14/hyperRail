<?php

use hyperRail\app\models\OAuthProviders\IOAuthProvider;

 /*
    |--------------------------------------------------------------------------
    | Twitter provider
    |--------------------------------------------------------------------------
 */

class TwitterProvider implements IOAuthProvider{

	/**
	 * Login Twitter-service
	 * 
	 * @return mixed
	 */
	public function getLogin() {
		// get data from input
        $code = Input::get('oauth_token');
        $verifier = Input::get('oauth_verifier');
        // dd('test');
        // get google service
        $twitterService = OAuth::consumer("Twitter","http://test.be/oauth/twitter");
        // dd('test');
        if (!empty($code)) {
            // This was a callback request from Twitter, get the token
            $token = $twitterService->requestAccessToken($code, $verifier);
            //dd($token);
            // Send a request with it
            $result = json_decode($twitterService->request('account/verify_credentials.json'));

            //echo 'result: <pre>' . print_r($result, true) . '</pre>';

            /*
            *   Save in database
            */
            //die();

            $user = Twitter::where('email', $result->screen_name)->first();

            if (empty($user)) {
                dd($token);
                $data = new User;
                $data->token = (string) $token;
                $data->departure = '';
                $data->name = $result->name;
                $data->email = $result->screen_name;
                //$data->first_name = $result['given_name'];
                //$data->last_name = $result['family_name'];
                $data->save();
            }

            if (Auth::attempt(array('email' => $result->screen_name))) {
                return Redirect::to('/');
            }  else {
            echo 'error';    
            }
        }
        // if not ask for permission first
        else {
            // extra request needed for oauth1 to request a request token
            $token = $twitterService->requestRequestToken();

            // get twitterService authorization
            $url = $twitterService->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));

            //dd($url);
           // dd((string) $url);
            header('Location: ' . (string) $url);
            die();
        }
    }
}  

?>