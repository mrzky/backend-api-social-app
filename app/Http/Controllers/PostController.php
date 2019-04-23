<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Comment;
use DB;

class PostController extends Controller
{
    //fungsi crud
    
    public function index() {
        $posts = DB::table('posts')->join('user_logins', 'posts.user_id', '=', 'user_logins.id')->get();
        $newPostArray = array();
        $newPostsObject = array();
        $postsLength = count($posts);

        for ($i=0; $i<$postsLength; $i++) {
            $oldPostArray = (array) $posts[$i];            
            $addToPostArray['likes']    = $this->sumOfLikes($oldPostArray['id']);
            $addToPostArray['comments'] = $this->sumOfComments($oldPostArray['id']);
            $newPostArray = $oldPostArray + $addToPostArray;
            $newPostsObject[] = $newPostArray;
        }

        return $newPostsObject;
    }

    public function create(Request $request) {

        $uploads_dir = '../assets/images/posts/';
        $foto = "";

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date("Y").date('m').date('d').date('G').date('i').date('s')."post.".$file->getClientOriginalExtension();
            $file->move($uploads_dir, $filename);
            $foto = $filename;
        }

        $post = new Post;
        $post->user_id   = $request->user_id;
        $post->title     = $request->title;
        $post->subtitle  = $request->subtitle;
        $post->image_url = $foto;
        if ($post->save()) {
            $res['success']  = true;
            $res['messages'] = 'Sukses dikirim!';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal dikirim! Ada kesalahan pada server';
            return response($res);
        }
    }

    public function update(Request $request, $id) {
        $title      = $request->title;
        $subtitle   = $request->subtitle;

        $post = Post::find($id);
        $post->title    = $title;
        $post->subtitle  = $subtitle;
        if ($post->save()) {
            $res['success']  = true;
            $res['messages'] = 'Sukses diubah!';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal diubah! Ada kesalahan pada server';
            return response($res);
        }
    }

    public function delete($id) {
        $post = Post::find($id);
        if ($post->delete()) {
            $res['success']  = true;
            $res['messages'] = 'Dihapus!';
            return response($res);
        } else {
            $res['success']  = false;
            $res['messages'] = 'Gagal dihapus! Ada kesalahan pada server';
            return response($res);
        }
    }


    //fungsi tambahan

    private function sumOfLikes($post_id) {
        $likes = Like::where('post_id', $post_id)->get();
        return count($likes);
    }

    private function sumOfComments($post_id) {
        $likes = Comment::where('post_id', $post_id)->get();
        return count($likes);
    }
}
