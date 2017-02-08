<?php

public function register(Request $request)
{
$rules = [
'name' => ['required'],
'phone' => ['required', 'min:11', 'max:11', 'unique:users'],
'password' => ['required', 'min:6', 'max:16'],
'key' => ['required', 'min:6'], // 手机验证码
];

$payload = $request->only('name', 'phone', 'password', 'key');
$validator = Validator::make($payload, $rules);

// 验证手机验证码
if (Cache::has($payload['phone'])) {
$key = Cache::get($payload['key']);
if ($key != $payload['key']) {
return $this->response->array(['error' => '验证码错误']);
}
} else {
return $this->response->array(['error' => '验证码错误']);
}

// 验证格式
if ($validator->fails()) {
return $this->response->array(['error' => $validator->errors()]);
}

// 创建用户
$result = Users::create([
'name' => $payload['name'],
'phone' => $payload['phone'],
'password' => bcrypt($payload['password']),
]);

if ($result) {
return $this->response->array(['success' => '创建用户成功']);
} else {
return $this->response->array(['error' => '创建用户失败']);
}

}