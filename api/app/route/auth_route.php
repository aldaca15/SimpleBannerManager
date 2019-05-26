<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Middleware\AuthMiddleware;

$app->group('/auth/', function () {
    
    $this->post('autenticar', function ($req, $res, $args) {
		$data = $req->getParsedBody();
		
		$email = $data['email'];
		$password = md5($data['password']);
		
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->auth->autenticar($email, $password)));
    });
	
});