<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function create(Request $request) {
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->liked_by_user_id = $request->liked_by_user_id;
        if ($like->save()) {
            $res['success']  = true;
            $res['messages'] = 'Disukai! <3';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal! Ada kesalahan pada server';
            return response($res);
        }
    }

    public function delete($id) {
        $like = Like::find($id);
        if ($like->delete()) {
            $res['success']  = true;
            $res['messages'] = 'Unliked! </3';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal! Ada kesalahan pada server';
            return response($res);
        }
    }
}
