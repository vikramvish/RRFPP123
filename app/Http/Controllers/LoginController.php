<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tbl_usermaster;
// use App\Models\tbl_transactiondetail;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class LoginController extends Controller {
    public function login() {
        return view( 'login' );
    }

    public function registration() {
        return view( 'registration' );
    }

    public function loginUser( Request $request ) {
        $validatedData = $request->validate( [
            'UserName' => 'required',
            'Password' => 'required',
        ] );
        // Guzzle is a PHP HTTP client library that makes it easy to
        // send HTTP requests and work with HTTP responses.

        $client = new \GuzzleHttp\Client();
        $cookieJar = new \GuzzleHttp\Cookie\CookieJar();

        $UserName = $request->input( 'UserName' );
        $Password = base64_encode( $request->input( 'Password' ) );
        $response = $client->post( 'http://sso.rajasthan.gov.in:8888/SSOREST/SSOAuthenticationJSON', [
            'form_params' => [
                'UserName' => $UserName,
                'Password' => $Password,
            ],
            'cookies' => $cookieJar,
        ] );

        $data = json_decode( $response->getBody(), true );

        if ( $data[ 'valid' ] !== true ) {
            $valid = $data[ 'valid' ];
            session( [ 'valid' => $valid ] );

            $msg = $data[ 'msg' ];
            session( [ 'msg' => $msg ] );
            // User not registered with SSO portal
            return redirect()
            ->back()->withInput( $request->only( 'UserName' ) )
            ->with( 'fail', 'Invalid credentials' );
        }

        // Check if user details are in database
        $user = tbl_usermaster::where( 'UserName', $validatedData[ 'UserName' ] )
        // ->where( 'Password', base64_encode( $validatedData[ 'Password' ] ) )
        ->first();

        if ( !$user ) {
            // User details not in database
            return redirect()
            ->back()->withInput( $request->only( 'UserName' ) )
            ->with( 'fail', 'User Not Mapped With Dashbaord' );
        }

        $userRights = DB::select( 'SELECT rm.RightCode 
                    FROM tbl_usermasters u 
                    INNER JOIN tbl_rolerights rr 
                    ON u.RoleId = rr.RoleId 
                    INNER JOIN tbl_rightmasters rm 
                    ON rr.RightId = rm.RightId 
                    WHERE u.UserName = ?', [ $UserName ] );
        //dd( $userRights );
        session( [ 'userRights' => $userRights ] );
        // dd( session( 'userRights' ) );

        if ( session( 'userRights' ) && $validatedData[ 'UserName' ] === $user->UserName ) {
            // Redirect to dashboard route if user details are valid and user rights session data is available
            return redirect()->route( 'dashboard' );
        } else {
            // Redirect back to login page if session data is not set or user details are invalid
            return redirect()
            ->back()->withInput( $request->only( 'UserName' ) )
            ->with( 'fail', 'You Did not have Role to Access Dashboard' );
        }
    }
    // Logout Function

    public function logout( Request $request ) {
        // Clear all session data
        session()->flush();
        //forget role session
        $request->session()->forget( 'userRights' );
        // Clear all cache data
        cache()->flush();

        // Redirect to the login page
        return redirect( '/login' );
    }
}
