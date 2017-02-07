<?php
namespace App\Http\Controllers\Api\V1;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use

class UserController extends Controller {

    use Helpers;

    public function register($user_name, Request $request)
    {
        if (User::where('name', $user_name)->count() > 0) {
            $this->response->errorBadRequest('该用户已经存在');
        }
        if (!preg_match('/^[a-z0-9]{6,15}$/', $user_name)) {
            $this->response->errorBadRequest('用户名由6-15位小写字母和数字组成');
        }
        $password = $request->json('password');
        $user = new User();
        $user->name = $user_name;
        $user->password = bcrypt($password);
        $user->save();
        return $this->response->created("/users/" . $user_name);
    }
}