<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::with('post')
            ->orderBy('id', 'desc')
            ->paginate(30);

        if ($request->expectsJson()) {
            return response()->json($comments);
        }

        return view('comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id'      => 'required|exists:posts,id',
            'author_name'  => 'nullable|string|max:150',
            'author_email' => 'nullable|email|max:150',
            'body'         => 'required|string',
        ]);

        $comment = Comment::create([
            'post_id'      => $data['post_id'],
            'user_id'      => $request->user()?->id,
            'author_name'  => $data['author_name'] ?? $request->user()?->name,
            'author_email' => $data['author_email'] ?? $request->user()?->email,
            'body'         => $data['body'],
            'is_approved'  => false, // admin will approve
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $comment], 201);
        }

        return back()->with('success', 'Comment submitted for review.');
    }

    public function show(Comment $comment, Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json($comment->load('post'));
        }

        return view('comments.show', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'body'        => 'nullable|string',
            'is_approved' => 'nullable|boolean',
        ]);

        $comment->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $comment]);
        }

        return redirect()->route('comments.index')->with('success', 'Comment updated.');
    }

    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('comments.index')->with('success', 'Comment deleted.');
    }
}
