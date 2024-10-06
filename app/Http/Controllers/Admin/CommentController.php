<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('movie')->orderBy('created_at', 'desc')->get();
        return view('admin.comment.show-comment', compact('comments'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Một bình luận đã bị xoá!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'bình luận tồn tại!'
            ]);
        }
    }
    public function activeComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->status = 1; // Kích hoạt Bình luận
            $comment->save();
            return response()->json(['status' => 'success', 'message' => 'Bình luận đã được kích hoạt!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể kích hoạt Bình luận!']);
        }
    }

    public function unactiveComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->status = 0; // Vô hiệu hóa Bình luận
            $comment->save();
            return response()->json(['status' => 'success', 'message' => 'Bình luận đã bị vô hiệu hóa!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Không thể vô hiệu hóa Bình luận!']);
        }
    }
}
