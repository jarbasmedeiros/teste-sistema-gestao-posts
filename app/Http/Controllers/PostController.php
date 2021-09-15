<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Notifications\PostCreated;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userPosts = $this->user->findOrFail(Auth::id())->posts;

        return view('dashboard', ['userPosts' => $userPosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $user = $this->user->findOrFail(Auth::id());
            $post = $user->posts()->create($request->validated());

            $user->notify(new PostCreated($post));

            return redirect()->route('posts.index')->with('success','Post cadastrado com sucesso!');

        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Desculpa!, não foi possível cadastrar o post!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        try {
            $post = $this->post->findOrFail($id);
            $post->update($request->validated());

            return redirect()->route('posts.index')->with('success','Post atualizado com sucesso!');

        } catch (Exception $exception) {
            return redirect()->route('posts.index')->with('error', 'Desculpa!, não foi possível atualizar o post!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success','Post removido com sucesso!');
    }
}
