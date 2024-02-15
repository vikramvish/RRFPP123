<?php

namespace App\Http\Controllers;

use App\Models\tbl_usermaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
    $validatedData = $request->validate([
        'UserName' => 'required',
        'Password' => 'required',
    ]);
    // Guzzle is a PHP HTTP client library that makes it easy to
    // send HTTP requests and work with HTTP responses.

    $client = new \GuzzleHttp\Client();
    $cookieJar = new \GuzzleHttp\Cookie\CookieJar();

    $UserName = $request->input('UserName');
    $Password = base64_encode($request->input('Password'));
    $response = $client->post('http://sso.rajasthan.gov.in:8888/SSOREST/SSOAuthenticationJSON', [
        'form_params' => [
            'UserName' => $UserName,
            'Password' => $Password,
        ],
        'cookies' => $cookieJar,
    ]);

    $data = json_decode($response->getBody(), true);

    if ($data['valid'] !== true) {
        $valid = $data['valid'];
        session(['valid' => $valid]);

        $msg = $data['msg'];
        session(['msg' => $msg]);
        // User not registered with SSO portal
        return redirect()
            ->back()->withInput($request->only('UserName'))
            ->with('fail', 'Invalid credentials');
    }

    // Check if user details are in database
    $user = tbl_usermaster::where('UserName', $validatedData['UserName'])
        ->where('IsActive', 1) // Add condition to check IsActive field
        ->first();
    // $user = tbl_usermaster::where('UserName', $validatedData['UserName'])
    // ->where('tbl_departmentusers.IsActive', 1)
    // ->leftJoin('tbl_departmentusers', 'tbl_usermasters.user_id', '=', 'tbl_departmentusers.user_id')
    // ->select('tbl_usermasters.*', 'tbl_departmentusers.DepartmentId')
    // ->get();
    // If you want to get all department_ids associated with the user, you can use pluck:
    // $departmentIds = $user->pluck('DepartmentId')->toArray();
    // dd($departmentIds);

    if (!$user) {
        // User details not in database
        return redirect()
            ->back()->withInput($request->only('UserName'))
            ->with('fail', 'User Not Mapped With Dashbaord');
    }

    // Get all department IDs associated with the user
    $departmentIds = DB::table('tbl_departmentusers')
        ->where('user_id', $user->user_id)
        ->pluck('DepartmentId')
        ->toArray();

    if (!$departmentIds) {
        // User has no associated departments
        return redirect()
            ->back()
            ->withInput($request->only('UserName'))
            ->with('fail', 'User has no associated departments');
    }

    $userRights = DB::select('SELECT rm.RightCode
            FROM tbl_usermasters u
            INNER JOIN tbl_rolerights rr ON u.RoleId = rr.RoleId
            INNER JOIN tbl_rightmasters rm ON rr.RightId = rm.RightId
            WHERE u.UserName = ?', [$UserName]);

    $roleId = $user->RoleId; // Assuming RoleId is stored in the $user object
    // $departmentId = $user->DepartmentId; // Assuming DepartmentId is stored in the $user object

    // Check if the user has both RoleId and DepartmentId
    // if ($userRights && $roleId && $departmentId) {
    //     // Store RoleId and DepartmentId in the session
    //     session(['userRights' => $userRights, 'roleId' => $roleId, 'departmentId' => $departmentId]);
    //     // dd(session('departmentId'));

    //     // Redirect to dashboard route if user details are valid and user rights session data is available
    //     return redirect()->route('dashboard');
    // } else {
    //     // Redirect back to login page if session data is not set or user details are invalid
    //     return redirect()
    //         ->back()
    //         ->withInput($request->only('UserName'))
    //         ->with('fail', 'You Do Not Have the Required Role or Department to Access the Dashboard');
    // }

    // Check if the user has both RoleId and at least one DepartmentId
    if ($userRights && $roleId && !empty($departmentIds)) {
        // Store RoleId and DepartmentIds in the session
        session(['userRights' => $userRights, 'roleId' => $roleId, 'departmentIds' => $departmentIds]);
    //    dd(session('departmentIds'));
        return redirect()->route('dashboard');
    } else {
        // Redirect back to the login page if session data is not set or user details are invalid
        return redirect()
            ->back()
            ->withInput($request->only('UserName'))
            ->with('fail', 'You Do Not Have the Required Role or Department to Access the Dashboard');
    }
}
    // Logout Function

    public function logout(Request $request)
    {
        // Clear all session data
        session()->flush();
        //forget role session
        $request->session()->forget('userRights');
        // Clear all cache data
        cache()->flush();

        // Redirect to the login page
        return redirect('/login');
    }
}
