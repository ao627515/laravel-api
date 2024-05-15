<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $query = Post::query();
            $perPage = 2;
            $page = $request->input('page',1);
            $seach = $request->input('seach');

            if($seach){
                $query->where('title','like','%'.$seach.'%');
            }
            $total = $query->count();

            $resultat = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

            return response()->json([
                'status' => 200,
                'message' => 'all post getting successfully',
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'items' => $resultat
            ]);

        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = auth()->user()->id;
            $post->save();

            return response()->json([
                'status' => 200,
                'message' => 'post created successfully',
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Updata the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            if(auth()->user()->id === $post->user_id){
                $post->title = $request->title;
                $post->description = $request->description;
                $post->save();
            }else{
                return response()->json([
                    'status' => 422,
                    'message' => 'Not authorization to update this post',
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'post updatad successfully',
                'data' => $post
            ]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {

            if(auth()->user()->id === $post->user_id){
                $post->delete();

            }else{
                return response()->json([
                    'status' => 422,
                    'message' => 'Not authorization to delete this post',
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'post deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
