<?php

namespace App\Http\Controllers;

use APP\Models\tbl_departmentmetadata;
//  Redirect to a given Laravel URL
use App\Models\tbl_pgmaster;
use App\Models\tbl_pgrequestlog;
use App\Models\tbl_transactiondetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class previewController extends Controller
{
    public function index()
    {
        $users = tbl_departmentmetadata::join('tbl_schememasters', 'tbl_departmentmetadata.SchemeId', '=', 'tbl_schememasters.SchemeId')->get();

        $prn = DB::table('tbl_transactiondetails')->value('PRN');
        return view('website/preview', compact('prn', 'users'));
    }
    public function anonmus()
    {
        $users = tbl_departmentmetadata::join('tbl_schememasters', 'tbl_departmentmetadata.SchemeId', '=', 'tbl_schememasters.SchemeId')->get();

        $prn = DB::table('tbl_transactiondetails')->value('PRN');
        return view('website/previewAnnonmous', compact('prn', 'users'));
    }

    public function Register(Request $request)
    {
        $request->validate([
            'RemitterName' => 'required',
            // 'RemitterPAN' => 'required',
            // 'RemitterAddress' => 'required|max:60',
            'RemitterEmailId' => 'required|email',
            'RemitterMobile' => 'required|numeric|digits:10',
            'TransactionAmount' => 'required|min:2',
        ]);

        $Form2 = new tbl_transactiondetail();
        $merchantCode = 'testMerchant2';
        $key = 'WFsdaY28Pf';
        $url = 'https://uat.rpp.rajasthan.gov.in/payments/v1/init';
        $date = Carbon::now();
        // $timeInMilliseconds = $date->valueOf();
        $todaydate = date('Ymdhmss');

        try {
            $SESSION = Session::get('txnid');
            $PRN = base64_decode($SESSION);
            $encodedPRN = base64_encode($PRN);
            $Form2->PRN = $PRN;

            // Check if the PRN already exists in the table
            $existingRecord = tbl_transactiondetail::where('PRN', $PRN)->first();

            if ($existingRecord) {
                // PRN already exists, show error
                return view('website/dublicatePRN_error');
                // echo "Duplicate PRN, The record already exists please go back and refresh the page";
            } else {
                // PRN doesn't exist, redirect the user
                $Form2->IsRemittanceAnnonymous = '1';

                // $Form2->TransactionID = request( 'PRN' );
                // -- BECAUSE OF THIS txn id has give new value in database

                $timestamp = $todaydate = date('Ymdhmss');
                $Form2->REQTIMESTAMP = $timestamp;

                $RemitterName = $request->RemitterName;
                $Form2->RemitterName = $RemitterName;

                $RemitterPAN = $request->RemitterPAN;
                $Form2->RemitterPAN = $RemitterPAN;

                $RemitterAddress = $request->RemitterAddress;
                $Form2->RemitterAddress = $RemitterAddress;

                $RemitterEmailId = $request->RemitterEmailId;
                $Form2->RemitterEmailId = $RemitterEmailId;

                $RemitterMobile = $request->RemitterMobile;
                $Form2->RemitterMobile = $RemitterMobile;

                $TransactionAmount = $request->TransactionAmount;
                $Form2->TransactionAmount = $TransactionAmount;

                // $Form2->SchemeId = $request->input( 'scheme_id' );
                $schemeId = $request->input('scheme_id');
                $Form2->SchemeId = $schemeId;

                // Query the database to fetch the corresponding DepartmentId
                $departmentId = DB::table('tbl_schememasters')
                    ->where('SchemeId', $schemeId)
                    ->value('DepartmentId');

                // Assign the DepartmentId to the $Form2 variable
                $Form2->DepartmentId = $departmentId;

                // checksum Calculate
                $calculatedChecksum = md5($merchantCode . '|' . $PRN . '|' . $TransactionAmount . '|' . $key);
                // $Form2->CHECKSUM = $calculatedChecksum;

                $jsonPlainData =
                    '{"MERCHANTCODE":"' .
                    $merchantCode .
                    '","PRN":"' .
                    $PRN .
                    '",
            "REQTIMESTAMP":"' .
                    $timestamp .
                    '","PURPOSE":"test","AMOUNT":"' .
                    $TransactionAmount .
                    '",
        "SUCCESSURL":"http://172.22.36.133:8000/successdata/' . $encodedPRN . '","FAILUREURL":"http://172.22.36.133:8000/data/' . $encodedPRN . '",
        "CANCELURL":"http://172.22.36.133:8000/data/' . $encodedPRN . '","USERNAME":"' .
                    $RemitterName .
                    '",
            "USERMOBILE":"' .
                    $RemitterMobile .
                    '","USEREMAIL":"' .
                    $RemitterEmailId .
                    '",
            "UDF1":"","UDF2":"","UDF3":"","OFFICECODE":"","REVENUEHEAD":"","CHECKSUM":"' .
                    $calculatedChecksum .
                    '",
            "CURRENCY":"INR"}';

                $encryption = new Aes256Encryption();
                $encryption->setKey('9759E1886FB5766DA58FF17FF8DD4');
                $encryptedStr = $encryption->encrypt($jsonPlainData);
                // $Form2->ENCDATA = $encryptedStr;
                // Session::put( 'encdata', ENCDATA );

                $Form2->save();

                // Code for INsert into tbl_requestlogs
                $log = new tbl_pgrequestlog();

                // Set the DecryptedRequest and EncryptedRequest fields
                $log->DecryptedRequest = $jsonPlainData;
                $log->EncryptedRequest = $encryptedStr;

                // Get the details from tbl_transactiondetails based on PRN
                $transactionDetail = tbl_transactiondetail::where('PRN', $PRN)->first();

                // Assign the foreign key variables
                $serviceTypeId = $transactionDetail->ServiceTypeId;

                $schemeId = $transactionDetail->SchemeId;
                // $departmentId = $transactionDetail->DepartmentId;
                $log->TransactionAmount = $TransactionAmount;
                // $log->TrackingID = $trackingId;
                $log->TrackingID = $encodedPRN;
                // $log->TrackingID = '00000';

                // You may also get the PGId from another table if necessary
                // $pgId = 1;
                $pgId = tbl_pgmaster::value('PGId');
                // example value
                $serviceTypeId = 1;

                $log->PRN = $PRN;

                $log->ServiceTypeId = $serviceTypeId;
                // $log->DepartmentId = $departmentId;
                $log->SchemeId = $schemeId;
                $log->PGId = $pgId;

                // Save the instance to the database
                $log->save();

                // Session::put( 'ENCDATA', $encryptedStr );
                echo '<form action="https://uat.rpp.rajasthan.gov.in/payments/v1/init" method="POST" id="frm_rpp">

                        <input type="hidden" name="ENCDATA" value="' .
                    $encryptedStr .
                    '">
                        <input type="hidden" name="MERCHANTCODE" value="testMerchant2">
                         <button type="submit" style="display: none;border: none;border-radius: 5px;padding: 9px;">Submit</button>
                         </form>
                         <script>
                             document.getElementById("frm_rpp").submit();
                         </script>';
                exit();
            }
        } catch (QueryException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function Annonmous(Request $request)
    {
        $request->validate([
            'TransactionAmount' => 'required|min:2',
        ]);
        $Form2 = new tbl_transactiondetail();
        $merchantCode = 'testMerchant2';
        $key = 'WFsdaY28Pf';

        try {
            $SESSION = Session::get('txnid');
            $PRN = base64_decode($SESSION);
            $encodedPRN = base64_encode($PRN);
            $Form2->PRN = $PRN;

            // Check if the PRN already exists in the table
            $existingRecord = tbl_transactiondetail::where('PRN', $PRN)->first();

            if ($existingRecord) {
                // PRN already exists, show error
                return view('website/dublicatePRN_error');
                // echo "Duplicate PRN, The record already exists please go back and refresh the page";
            } else {
                // $prn = random_int( 1000000, 9999999 );
                // $Form2->PRN = $prn;

                // Session::put( 'PRN', $prn );

                $timestamp = $todaydate = date('Ymdhmss');
                $Form2->REQTIMESTAMP = $timestamp;
                $Form2->IsRemittanceAnnonymous = '0';

                // dd( $timestamp );
                $RemitterName = 'Not provided';
                $Form2->RemitterName = $RemitterName;

                $RemitterPAN = $request->RemitterPAN;
                $Form2->RemitterPAN = $RemitterPAN;

                $RemitterAddress = $request->RemitterAddress;
                $Form2->RemitterAddress = $RemitterAddress;

                $RemitterEmailId = 'Not provided';
                $Form2->RemitterEmailId = $RemitterEmailId;

                $RemitterMobile = 'Not provided';
                $Form2->RemitterMobile = $RemitterMobile;

                $TransactionAmount = $request->TransactionAmount;
                $Form2->TransactionAmount = $TransactionAmount;

                // $Form2->SchemeId = $request->input( 'scheme_id' );
                // $Form2->SchemeId = request( 'scheme' );

                $schemeId = $request->input('scheme_id');
                $Form2->SchemeId = $schemeId;

                $departmentId = DB::table('tbl_schememasters')
                    ->where('SchemeId', $schemeId)
                    ->value('DepartmentId');

                // Assign the DepartmentId to the $Form2 variable
                $Form2->DepartmentId = $departmentId;

                // $selectedScheme = $request->input( 'scheme' );
                // $scheme = tbl_schememaster::find( $selectedScheme );
                // $Form2->SchemeId = $selectedScheme;
                // $Form2->DepartmentId = $scheme->DepartmentId;

                // checksum Calculate
                $calculatedChecksum = md5($merchantCode . '|' . $PRN . '|' . $TransactionAmount . '|' . $key);
                // $Form2->CHECKSUM = $calculatedChecksum;
                // $randomBytes = random_bytes( 16 );
                // $trackingId = bin2hex( $randomBytes );

                $jsonPlainData =
                    '{"MERCHANTCODE":"' .
                    $merchantCode .
                    '","PRN":"' .
                    $PRN .
                    '",
            "REQTIMESTAMP":"' .
                    $timestamp .
                    '","PURPOSE":"test","AMOUNT":"' .
                    $TransactionAmount .
                    '",
            "SUCCESSURL":"http://172.22.36.133:8000/successdata/' . $encodedPRN . '","FAILUREURL":"http://172.22.36.133:8000/data/' . $encodedPRN . '",
            "CANCELURL":"http://172.22.36.133:8000/data/' . $encodedPRN . '","USERNAME":"Annonymous",
            "USERMOBILE":"0000000000","USEREMAIL":"Annonymous@gmail.com",
            "UDF1":"","UDF2":"","UDF3":"","OFFICECODE":"","REVENUEHEAD":"","CHECKSUM":"' .
                    $calculatedChecksum .
                    '",
            "CURRENCY":"INR"}';

                $encryption = new Aes256Encryption();
                $encryption->setKey('9759E1886FB5766DA58FF17FF8DD4');
                $encryptedStr = $encryption->encrypt($jsonPlainData);
                // $Form2->ENCDATA = $encryptedStr;
                // Session::put( 'encdata', ENCDATA );
                // dd( $Form2 );
                $Form2->save();

                $log = new tbl_pgrequestlog();

                // Set the DecryptedRequest and EncryptedRequest fields
                $log->DecryptedRequest = $jsonPlainData;
                $log->EncryptedRequest = $encryptedStr;

                // Get the details from tbl_transactiondetails based on PRN
                $transactionDetail = tbl_transactiondetail::where('PRN', $PRN)->first();

                // Assign the foreign key variables
                $serviceTypeId = $transactionDetail->ServiceTypeId;

                $schemeId = $transactionDetail->SchemeId;
                // $departmentId = $transactionDetail->DepartmentId;
                $log->TransactionAmount = $TransactionAmount;
                $log->TrackingID = $encodedPRN;
                // $log->TrackingID = '000000';

                // You may also get the PGId from another table if necessary
                // $pgId = 1;
                $pgId = tbl_pgmaster::value('PGId');
                $serviceTypeId = 1;

                $log->PRN = $PRN;

                $log->ServiceTypeId = $serviceTypeId;
                // $log->DepartmentId = $departmentId;
                $log->SchemeId = $schemeId;
                $log->PGId = $pgId;

                // Save the instance to the database
                $log->save();

                // Session::put( 'ENCDATA', $encryptedStr );
                echo '<form action="https://uat.rpp.rajasthan.gov.in/payments/v1/init" method="POST" id="frm_rpp">

                        <input type="hidden" name="ENCDATA" value="' .
                    $encryptedStr .
                    '">
                        <input type="hidden" name="MERCHANTCODE" value="testMerchant2">
                         <button type="submit" style="display: none;border: none;border-radius: 5px;padding: 9px;">Submit</button>
                         </form>
                         <script>
                             document.getElementById("frm_rpp").submit();
                         </script>';
                exit();
            }

        } catch (QueryException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }}

class Aes256Encryption
{
    public $key;
    public $iv;
    public $method = 'AES-256-CBC';

    public function encrypt($toBeEncryptString)
    {
        return openssl_encrypt($toBeEncryptString, $this->method, hex2Bin($this->key), 0, hex2Bin($this->iv));
    }

    public function decrypt($toBeDecryptString)
    {
        return openssl_decrypt($toBeDecryptString, $this->method, hex2Bin($this->key), 0, hex2Bin($this->iv));
    }

    public function setKey($key)
    {
        $this->key = hash('sha256', $key);
        $this->iv = md5($key);
    }
}
