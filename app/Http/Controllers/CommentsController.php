<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments($postId)
    {
        try {
            $comments = Comment::where('post_id', $postId)->get();
            return response()->json($comments, 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function createComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        try {
            $comment = Comment::create([
                'comment' => $request->comment,
                'post_id' => $postId,
                'user_id' => $request->user_id,
            ]);

            return response()->json(['msg' => 'Berhasil menambah komentar', 'comment' => $comment], 201);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function updateComment(Request $request, $commentId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        try {
            $comment = Comment::findOrFail($commentId);
            $comment->update([
                'comment' => $request->comment,
            ]);

            return response()->json(['msg' => 'Berhasil mengubah komentar', 'comment' => $comment], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    public function deleteComment($commentId)
    {
        try {
            $comment = Comment::findOrFail($commentId);
            $comment->delete();

            return response()->json(['msg' => 'Berhasil menghapus komentar'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }
}
