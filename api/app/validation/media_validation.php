<?php
namespace App\Validation;

use App\Lib\Response;

class MediaValidation {
    public static function validate($data) {

        $response = new Response();

        $key = 'resource';
        if(empty($data[$key])){
            $response->errors[$key][] = 'Resource location is required';
        } else {
            $value = $data[$key];

            if(strlen($value) > 120) {
                $response->errors[$key][] = 'Resource location too long...';
            }
        }

        $key = 'destinationURL';
        if(empty($data[$key])){
            $response->errors[$key][] = 'Destination-url location is required';
        } else {
            $value = $data[$key];

            if(strlen($value) > 125) {
                $response->errors[$key][] = 'Destination-url location too long...';
            }
        }

        $key = 'idBanner';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'IdBanner is required';
        } else {
            $value = $data[$key];
        }

        $key = 'width';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Width is required';
        } else {
            $value = $data[$key];
        }

        $key = 'height';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Height is required';
        } else {
            $value = $data[$key];
        }

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}
