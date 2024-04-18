<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-post|edit-post|delete-post', ['only' => ['create','store']]);
        $this->middleware('permission:edit-post', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-post', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $posts = Post::latest()->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sujet' => 'required',
            'content' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->withSuccess('New post is added successfully.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'sujet' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->withSuccess('Post is updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index')->withSuccess('Post is deleted successfully.');
    }
}
