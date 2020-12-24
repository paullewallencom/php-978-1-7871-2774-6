<?php

use Tymon\JWTAuth\Facades\JWTAuth;

class CreatePostCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests if it let unauthorized user to create post
    public function tryToCreatePostWithoutLogin(ApiTester $I)
    {
        //This will be in console like a comment but effect nothing
        $I->wantTo("Send sending Post Data to create Post to test if it let it created without login?");

        //get random data generated through ModelFactory
        $postData = factory(App\Post::class, 1)->make()->first()->toArray();

        //Send Post data through Post method
        $I->sendPost("/posts", $postData);

        //This one will also be like a comment in console
        $I->expect("To receive a unauthorized error resposne");

        //Response code of unauthorized request should be 401
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
    }

    // tests if it let unauthorized user to create post
    public function tryToCreatePostAfterLogin(ApiTester $I)
    {
        //This will be in console like a comment but effect nothing
        $I->wantTo("Sending Post Data to create Post after login");

        $user = App\User::first();
        $token = JWTAuth::fromUser($user);

        //get random data generated through ModelFactory
        $postData = factory(App\Post::class, 1)->make()->first()->toArray();

        //Send Post data through Post method
        $I->amBearerAuthenticated($token);
        $I->sendPost("/posts", $postData);

        //This one will also be like a comment in console
        $I->expect("To receive a 200 response");

        //Response code of unauthorized request should be 200
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($postData);

    }
}
