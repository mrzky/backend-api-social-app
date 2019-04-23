<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{

    public function index($id) {
        return Comment::where('post_id', $id)->get();
    }

    public function create(Request $request) {
        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->commented_by_user_id = $request->commented_by_user_id;
        $comment->comment_body = $request->comment_body;
        if ($comment->save()) {
            $res['success']  = true;
            $res['messages'] = 'Ok! :)';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal! Ada kesalahan pada server';
            return response($res);
        }
    }

    public function update(Request $request, $id) {
        $comment_body = $request->comment_body;

        $comment = Comment::find($id);
        $comment->comment_body = $comment_body;
        if ($comment->save()) {
            $res['success']  = true;
            $res['messages'] = 'Alright! :)';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal! Ada kesalahan pada server';
            return response($res);
        }
    }

    public function delete($id) {
        $comment = Comment::find($id);
        if ($comment->delete()) {
            $res['success']  = true;
            $res['messages'] = 'Yep! :/';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal! Ada kesalahan pada server';
            return response($res);
        }
    }
}
