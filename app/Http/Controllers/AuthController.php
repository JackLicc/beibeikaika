<?php
namespace App\Http\Controllers;
use App\Helpers\ErrorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{

    /**
     * Create user
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'verification_code' => 'required|string'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return $this->error(ErrorCode::EMAIL_HAS_BEEN_TAKEN);
        }

        if ((int) $request->verification_code !== session('register_verification_code')) {
            return $this->error(ErrorCode::INVALID_VERIFICATION_CODE);
        }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'referral_code' => $request->referralCode,
        ]);
        $user->save();
        return $this->success();
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return $this->error(ErrorCode::INVALID_CREDENTIALS);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return $this->success([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        Log::info('logout');
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Get registration verification code
     * @return false|string
     */
    public function getRVCode() {
        $code = rand(1000, 9999);
        session(['register_verification_code' => $code]);
        if (App::environment('production')) {
            return $this->success();
        }
        return $this->success(['code' => $code]);
    }
}
