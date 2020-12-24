<?php
class App
{
    public function __construct()
    {
        //some code here
    }
}

function useApp(App $app)
{
    //use app somewhere
}

$app = new App();
useApp($app);
