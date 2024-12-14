<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json([$comments], 200);
    }

    public function show($id)
    {
        $comments = Comment::where('post_id', $id)->get();
        if ($comments->isNotEmpty()) {
            return response()->json($comments, 200);
        }
        return response()->json(["message" => "No Comments yet"], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|integer',
        ]);
        $post = new Comment();
        $post->comment = $request->input('comment');
        $post->post_id = $request->input('post_id');
        $post->user_id = Auth::id();
        $post->save();

        if ($post) {
            return response()->json(['message' => 'Comment added sucessfully'], 200);
        } else {
            return response()->json(['message' => 'Something Went Wrong'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'comment' => 'required|string|max:255',
                'post_id' => 'required|integer',
            ]);
            $comment = Comment::where('id', $id)->first();
            // dd($comment->user_id);
            if (is_null($comment)) {
                throw new Exception('Comment not found');
            }
            if ($comment->user_id != Auth::user()->id) {
                throw new Exception('Comment doesnot belongs to the user');
            }
            if ($comment->post_id != $request->post_id) {
                throw new Exception('Comment not found');
            }
            $comment->comment = $request->comment;
            $comment->save();
            return response()->json(['message' => 'Comment updated sucessfully'], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::find($id);
            $post = Post::where('id', $comment->post_id)->first();

            if (is_null($comment)) {
                throw new Exception('Comment not found');
            }
            if ($comment->user_id != Auth::user()->id && $post->user_id != Auth::user()->id && Auth::user()->role != "SuperAdmin") {
                throw new Exception('You are not authorized to delete the comment');
            }
            $comment->delete();
            return response()->json(['message' => 'Comment deleted sucessfully'], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}


