<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\MediaValidation,
    App\Middleware\AuthMiddleware;

$app->group('/media/', function () { //Secured

    $this->get('listAll/', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->media->listAll()));
    });

    $this->post('newMedia', function ($req, $res, $args) {
		    $r = MediaValidation::validate($req->getParsedBody());

        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }

        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->media->post($req->getParsedBody())));
    });

    $this->put('update/{idBanner}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->media->update($req->getParsedBody(), $args['idBanner'])));
    });

})->add(new AuthMiddleware($app));

$app->group('/media/', function () { //Public

    $this->get('get/{idBanner}', function ($req, $res, $args) {

		    $this->model->media->update($req->getParsedBody(), $args['idBanner']);

        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->media->get($args['idBanner'])));
    });

});
