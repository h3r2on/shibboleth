<?php namespace H3r2on/Shibboleth\Http;

use App\Http\Controllers\Controller;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Request, Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param GenericUser $user
	 */
	public function __construct(GenericUser $user = null)
	{
		$this->user = $user;
	}

	/**
	 * Redirect the to the SP for Authentication
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function create()
	{
		return redirect('https://' . Request::server('SERVER_NAME') . config('shibboleth.idp_login') . '?target=' . route('auth::callback'));
	}

	/**
	 * Accept the IDP callback and proccess the response
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function idpAuthorize(Request $request)
	{

		$email = Request::server('REDIRECT_'. config('shibboleth.idp_login_email'));
		$firstName = Request::server('REDIRECT_' . config('shibboleth.idp_login_first'));
		$lastName = Request::server('REDIRECT_' . config('shibboleth.idp_login_last');

		$userClass = config('auth.model');

		if (Auth::attempt(array('email' => $email), true)) {
			$user = $userClass::where('email', '=', $email)->first();

			if (isset($firstName)) {
				$user->first_name = $firstName;
			}

			if (isset($lastName)) {
				$user->last_name = $lastName;
			}

			if(!$user->save()) {

			}

			//redirect to the base secured route
			return redirect()->route(config('shibboleth.idp_authenticated'));

		} else {
			// redirect to unauthorized eror page
			return redirect()->route(config('shibboleth.idp_unauthorized'));;
		}
		// redirect to unauthorized eror page
		return redirect()->route(config('shibboleth.idp_unauthorized'));;
	}


	/**
	 * Destroy the current session and log the user out, redirect them to the main route.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Request $request)
	{
		Auth::logout();
		Session::flush();
		return redirect('https://' . Request::server('SERVER_NAME') . config('shibboleth.idp_logout'));
	}
}
