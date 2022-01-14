<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected static $rules = [
        'title' => 'required',
        'post_type_id' => 'required|integer|min:1',
        'body' => 'required'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);

        //get posts by user_id joined to post_type to get post_type name
        $posts = $user
            ->posts()
            ->join('post_types', 'post_types.id', '=', 'posts.post_type_id')
            ->select('posts.*', 'post_types.name as post_type')
            ->paginate(6);

        return view('post.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')
            ->with('post_types', PostType::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(self::$rules);

        Post::create([
            'title' => $request->input('title'),
            'user_id' => auth()->user()->id,
            'post_type_id' => $request->input('post_type_id'),
            'body' => $request->input('body'),
        ]);

        return redirect('/post')
            ->with('message', 'Your post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $post$
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['post'] = Post::where('id', $id)->first();
        $data['post_types'] = PostType::get();

        return view('post.edit')
            ->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(self::$rules);

        Post::where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'user_id' => auth()->user()->id,
                'post_type_id' => $request->input('post_type_id'),
                'body' => $request->input('body'),
            ]);

        return redirect('/post')
            ->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id);
        $post->delete();

        return redirect('/post')
            ->with('message', 'Your post has been deleted!');
    }
}
