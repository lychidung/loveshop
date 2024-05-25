<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;

use function PHPUnit\Framework\throwException;

class PostController extends Controller
{
    public function index($id = null)
    {
        if ($id == null)
        {
            return Post::orderby('id', 'ASC')->get();
        } else {
            return Post::find($id);
        }
    }

    public function create (Request $request)
    {
        try{
            $post = new Post();
            $post->id_user = $request->input('id_user');
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->image = $request->input('image');
            $post->status = $request->input('status');
            $post->save();
            return $post;

        } catch (Throwable $err){
            return $err->getMessage();
        }
    }

    public function update ($id, Request $request)
    {
        try{
            $post = Post::find($id);
            if($post)
            {
                $post->id_user = $request->input('id_user');
                $post->title = $request->input('title');
                $post->body = $request->input('body');
                $post->image = $request->input('image');
                $post->status = $request->input('status');
                $post->save();
                return $post;
            }
            else{
                return 'Không tìm thấy bài Post';
            }
            
            
        } catch (Throwable $err){
            return $err->getMessage();
        }      
    }

    public function delete ($id)
    {
        try{
            $post = Post::find($id);
            if($post)
            {
                $post->delete();
                return $post;
            }
            else{
                return 'Không tìm thấy bài Post';
            }         
        } catch (Throwable $err){
            return $err->getMessage();
        }      
    }

}
