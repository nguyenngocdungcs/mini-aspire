<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator, Hash;
use App\User;

trait ChangePassword
{
    public function getChangePassword()
    {
        return view('auth.passwords.change_password');
    }

    public function postChangePassword(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password'
        ]);
        if ($validator->fails()) {
            return $this->sendChangePasswordFailedResponse($validator->errors()->first());
        }

        $current_password = Auth::User()->password;
        if (!Hash::check($data['old_password'], $current_password)) {
            return $this->sendChangePasswordFailedResponse('Please enter correct old password');
        }
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($data['new_password']);
        $obj_user->save();
        return $this->sendChangePasswordSuccessResponse('Change password successfully!');
    }

    protected function sendChangePasswordSuccessResponse($response = '')
    {
        flash($response, 'success');
        return redirect(route('home'));
    }

    protected function sendChangePasswordFailedResponse($response = '')
    {
        flash($response, 'danger');
        return back();
    }
}