<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dingo\Api\Routing\Helpers;
use App\Transformers\PostTransformer;

class PostController extends Controller
{
    use Helpers;

    public function __construct(\App\Post $post, \App\Transformers\PostTransformer $postTransformer)
    {

        $this->user = JWTAuth::parseToken()->authenticate();

        $this->post = $post;

        $this->transformer = $postTransformer;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->paginate(20);

        return $this->response->paginator($posts, $this->transformer);
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
        $input['user_id'] = $this->user->id;

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

        return $this->response->item($post, $this->transformer);
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

        return $this->response->item($post, $this->transformer);
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

        if($this->user->id != $post->user_id){
            return new JsonResponse(
                [
                    'errors' => 'Only Post Owner can update it'
                ], Response::HTTP_FORBIDDEN
            );
        }

        $post->fill($input);
        $post->save();

        return $this->response->item($post, $this->transformer);
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

        if($this->user->id != $post->user_id){
            return new JsonResponse(
                [
                    'errors' => 'Only Post Owner can delete it'
                ], Response::HTTP_FORBIDDEN
            );
        }

        $post->delete();

        return ['message' => 'deleted successfully', 'post_id' => $id];
    }
}
