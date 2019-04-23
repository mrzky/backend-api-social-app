<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserLogin;

class UserLoginController extends Controller
{
    //fungsi crud

    public function index() {
        return UserLogin::all();
    }

    public function create(Request $request) {
        if (!$this->isUsernameExist($request->username)) {
            $user = new UserLogin;
            $user->username = $request->username;
            $user->email    = $request->email;
            $user->password = md5($request->password);
            $user->token    = $request->token;
            if ($user->save()) {
                $res['success']  = true;
                $res['messages'] = 'Daftar sukses!';
                return response($res);
            } else {
                $res['success']  = false;
                $res['messages'] = 'Daftar Gagal! Ada kesalahan pada server';
                return response($res);
            }
        } else {
            $res['success']  = false;
            $res['messages'] = 'Username telah digunakan!';
            return response($res);
        }
    }

    public function update(Request $request, $id) {
        $email      = $request->email;
        $password   = md5($request->email);
        $token      = $request->token;

        $user = UserLogin::find($id);   
        $user->email     = $email;
        $user->password  = $password;
        $user->token     = $token;
        if ($user->save()) {
            $res['success']  = true;
            $res['messages'] = 'Data sukses diubah!';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Data gagal diubah! Ada kesalahan pada server';
            return response($res);
        }
    }

    public function delete($id) {
        $user = UserLogin::find($id);
        if ($user->delete()) {
            $res['success']  = true;
            $res['messages'] = 'Data sukses dihapus!';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Data gagal dihapus! Ada kesalahan pada server';
            return response($res);
        }
    }

    //fungsi login

    public function login(Request $request) {
        $username = $request->username;
        $password = md5($request->password);

        $login = Userlogin::where('username', $username)->where('password', $password)->get();
        if (count($login) != 0) {
            $res['success']  = true;
            $res['messages'] = 'Login sukses!';
            $res['user']     = $login[0];
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Login gagal! Mohon periksa kembali..';
            return response($res);
        }
    }

    //fungsi tambahan

    private function isUsernameExist($username) {
        $user = UserLogin::where('username', $username)->get();
        if (count($user) != 0) {
            return true;
        } else {
            return false;
        }
    }
}
