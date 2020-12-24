<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{

    public function __construct(\App\Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->comment->paginate(20);
        $data = $records['data'];

        $response = [
            'data' => $data,
            'total_count' => $records['total'],
            'limit' => $records['per_page'],
            'pagination' => [
                'next_page' => $records['next_page_url'],
                'current_page' => $records['current_page']
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

        $this->post->create($input);

        return [
            'data' => $input
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
