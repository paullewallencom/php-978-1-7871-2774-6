<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{

    public function __construct(\App\Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->paginate(20);
        $data = $posts->items();

        $response = [
            'data' => $data,
            'total_count' => $posts->total(),
            'limit' => $posts->perPage(),
            'pagination' => [
                'next_page' => $posts->nextPageUrl(),
                'current_page' => $posts->previousPageUrl()
            ]
        ];

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validationRules = [
            'content' => 'required|min:1',
            'title' => 'required|min:1',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|exists:users,id'
        ];

        $validator = \Validator::make($input, $validationRules);
        if ($validator->fails()) {
            return new JsonResponse(
                [
                    'errors' => $validator->errors()
                ], Response::HTTP_BAD_REQUEST
            );
        }

        $post = $this->post->create($input);

        return [
            'data' => $post
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->post->find($id);

        if(!$post) {
            abort(404);
        }

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $post = $this->post->find($id);

        if(!$post) {
            abort(404);
        }

        $post->fill($input);
        $post->save();

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->find($id);

        if(!$post) {
            abort(404);
        }

        $post->delete();

        return ['message' => 'deleted successfully', 'post_id' => $id];
    }
}
