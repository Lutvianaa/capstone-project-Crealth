<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts($userId)
    {
        try {
            $posts = Post::where('user_id', $userId)->get();
            return response()->json($posts, 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        try {
            $post = Post::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'user_id' => $request->user_id, 
            ]);

            return response()->json(['msg' => 'Berhasil menambah post', 'post' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function updatePost(Request $request, $postId)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        try {
            $post = Post::findOrFail($postId);

            $post->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json(['msg' => 'Berhasil mengubah post', 'post' => $post], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function deletePost($postId)
    {
        try {
            $post = Post::findOrFail($postId);
            $post->delete();

            return response()->json(['msg' => 'Berhasil menghapus post'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }
}
