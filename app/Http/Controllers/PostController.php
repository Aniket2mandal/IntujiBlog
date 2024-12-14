<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::with(['image', 'comments'])->get();
        return response()->json([$post], 200);
    }
    public function UserPosts(Request $request)
    {
        $posts = Post::where('user_id', Auth::user()->id)->with(['image', 'comments'])->get();
        if ($posts->isEmpty()) {
            return response()->json(['message' => 'No post created by the user'], 201);
        }
        return $posts;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::id();
            $post->save();

            $image = $request->file('image');
            $destinationPath = public_path('assets/images');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $filename);

            $image = new Image();
            $image->path = $filename;
            $image->post_id = $post->id;
            $image->save();
            DB::commit();
            if ($post) {
                return response()->json(['message' => 'Post Created Sucessfully'], 200);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show(Request $request, $id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['message' => 'No post found'], 404);
        }
        return response()->json($post, 200);
    }

    public function update(Request $request, $id)
    {

        // dd($request->content);
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $post = Post::find($id);

            if (is_null($post)) {
                throw new Exception('Post not found');
            }
            if ($post->user_id != Auth::user()->id && Auth::user()->role != "SuperAdmin") {
                throw new Exception('Post doesnot belongs to the user');
            }


            if ($request->hasFile('image')) {
                $oldimage = Image::where('post_id', $post->id)->first();

                $filepath = public_path('assets/images/' . $oldimage->path);
                if (file_exists($filepath)) {
                    unlink(public_path('assets/images/' . $oldimage->path));
                }
                $image = $request->file('image');
                $destinationPath = public_path('assets/images');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $filename);

                $oldimage->path = $filename;
                $oldimage->save();
            }

            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
            $imagePath = Image::where('post_id', $post->id)->first();
            return response()->json(['post' => $post, 'image' => $imagePath->path], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $post = Post::find($id);

            if (is_null($post)) {
                throw new Exception('Post not found');
            }
            if ($post->user_id != Auth::user()->id && Auth::user()->role != "SuperAdmin") {
                throw new Exception("You are not authorized to delete the post");
            }

            $oldimage = Image::where('post_id', $post->id)->first();
            $filepath = public_path('assets/images/' . $oldimage->path);
            if (file_exists($filepath)) {
                unlink(public_path('assets/images/' . $oldimage->path));
            }

            $post->delete();
            return response()->json(['message' => 'Post deleted sucessfully'], 200);

            // return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
