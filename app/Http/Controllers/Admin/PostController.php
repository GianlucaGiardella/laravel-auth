<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $validations = [
        'title'         => 'required|string|min:5|max:100',
        'url_image'     => 'required|url|max:400',
        'content'        => 'required|string',
    ];

    private $validationMessages = [
        'required' => 'Il campo :attribute è richiesto.',
        'url' => 'Il campo deve essere un url valido',
        'min' => 'Il campo :attribute deve avere almeno :min caratteri',
        'max' => 'Il campo :attribute non deve superare i :max caratteri.',
    ];

    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->url_image = $data['url_image'];
        $newPost->content = $data['content'];
        $newPost->save();

        return to_route('admin.posts.show', ['post' => $newPost]);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $post->title = $data['title'];
        $post->url_image = $data['url_image'];
        $post->content = $data['content'];
        $post->update();

        return to_route('admin.posts.show', ['post' => $post]);
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return to_route('admin.posts.index')->with('delete_success', $post);
    }
}