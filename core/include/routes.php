<?php

use Slim\Http\Request;
use Slim\Http\Response;
//所有路由的配置
// Routes
use Prezto\IpFilter\IpFilterMiddleware;
use Prezto\IpFilter\Mode;
$app = Cc\Core\Main::getApp(PHP_SAPI);

//# Instantiate with a single address. Allow only one ip.
//$filter = new IpFilterMiddleware(['192.168.1.7'], Mode::DENY);
//
//# Instantiate with an address range. Allow only this range.
//$filter = new IpFilterMiddleware([['192.168.1.100', '192.168.1.200']], Mode::DENY);

$app->get('/user/ddd', \CC\Api\User\UserApi::class. ':dddExecute')->setName('userList');

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return 'this is index response' . PHP_EOL;
});

//第一个版本路由
$app->group('/v1/user', function () {
    $path = explode('/', $this->getContainer()->get('request')->getUri()->getPath());
    $Api = array_pop($path);
    $this->get('/' . $Api, \CC\Api\User\UserApi::class. ':' . $Api . 'Execute')->setName('userList');
});

$app->get('/user/ccc', function (Request $request, Response $response, array $args) {
    $obj = $this->cityDB->table('time_st')->get();
    print_r($obj);
})->setName('userInfo');


/**
getScheme()
getAuthority()
getUserInfo()
getHost()
getPort()
getPath()
getBasePath()
getQuery() (返回整个查询字符串，e.g. a=1&b=2)
getFragment()
getBaseUrl()
 */

/*  参考route+url
$app = new \Slim\App();
$app->get('/hello/{name}', function ($request, $response, $args) {
    echo "Hello, " . $args['name'];
})->setName('hello');
You can generate a URL for this named route with the application router’s pathFor() method.

echo $app->getContainer()->get('router')->pathFor('hello', [
    'name' => 'Josh'
]);
// Outputs "/hello/Josh"
*/