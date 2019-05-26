<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\BannerValidation,
    App\Middleware\AuthMiddleware;

$app->group('/banner/', function () {

    $this->get('listAll/', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->banner->listAll()));
    });

    $this->get('get/{idBanner}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->banner->get($args['idBanner'])));
    });

    $this->post('newBanner', function ($req, $res, $args) {
		$r = BannerValidation::validate($req->getParsedBody());

        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }

        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->banner->post($req->getParsedBody())));
    });

})->add(new AuthMiddleware($app));
