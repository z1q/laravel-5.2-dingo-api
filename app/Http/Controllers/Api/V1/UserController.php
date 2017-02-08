<?php
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
//use GuzzleHttp\Client;
use LeanCloud\User;
use LeanCloud\Client;

class UserController extends Controller
{
    use Helpers;

    public function reg(Request $request)
    {
        Client::initialize(env('LC_APP_ID'),env('LC_APP_KEY'),env('LC_APP_MASTER_KEY'));
        $user = new User();
        switch ($request->type) {
            case "ruser":
                $ru = $request->rusername;
                $rp = $request->rpassword;
                $user->setUsername($ru);
                $user->setPassword($rp);
                if($request->rphonenum){$user->setMobilePhoneNumber($request->rphonenum);}
                break;
            case "ruserlogin":
                User::logInWithSmsCode($request->rphonenum, $request->smscode);
                break;
            case "rphone":
                User::requestLoginSmsCode($request->rphonenum);
                break;
            case "rphonelogin":
                User::logInWithSmsCode($request->rphonenum,$request->smscode);
                break;
        }

        if($user->signUp()){return 'success';}
    }

    public function verif(Request $request){
        switch ($request->type) {
            case "email":
                User::requestEmailVerify($request->remail);
                break;
            case "phone":
                User::resetPasswordBySmsCode("123456", "password");
                break;
        }
    }

    public function login(Request $request){
        switch ($request->type) {
            case "username":
                User::logIn($request->username,$request->password);
                break;
            case "phone":
                User::logInWithMobilePhoneNumber($request->phonenum,$request->password);
                break;
            case "pverif":
                User::requestLoginSmsCode($request->phonenum);
                User::logInWithSmsCode($request->phonenum,$request->smscode);
                break;
        }
    }
    public function forget(Request $request){
        switch ($request->type) {
            case "email":
                User::requestPasswordReset($request->email);
                break;
            case "phone":
                User::requestPasswordResetBySmsCode($request->phonenum);
                User::resetPasswordBySmsCode($request->verif, $request->password);
                break;
        }
    }
}