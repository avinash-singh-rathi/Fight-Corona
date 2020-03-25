<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(15);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|unique:posts',
            'content'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images/news'), $imageName);
        $path='images/news/'.$imageName;

        $post = new Post([
            'name' => $request->get('name'),
            'content' => $request->get('content'),
            'image' => $path
        ]);
        $post->save();
        return redirect('/posts')->with('success', 'News article created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            'name'=>'required|unique:posts,name,'.$post->id,
            'content'=>'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,JPEG,JPG,PNG,GIF,SVG'
        ]);
        if($request->image){
              $imageName = time().'.'.$request->image->extension();
              $request->image->move(public_path('images/news'), $imageName);
              $path='images/news/'.$imageName;
              $post->name = $request->get('name');
              $post->content = $request->get('content');
              $post->image = $path;
        }else{
            $post->name = $request->get('name');
            $post->content = $request->get('content');
        }
        $post->save();
        return redirect()->back()->with('success', 'News article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect('/posts')->with('success', 'News article deleted successfully!');
    }
}
