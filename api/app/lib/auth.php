<?php
namespace App\Lib;

use Firebase\JWT\JWT,
    Exception;

class Auth
{
    private static $secret_key = 'GUx5@636o';
    private static $encrypt = array('HS256');
    private static $aud = null;
    private static $minutes = 60;

    // Token creation
    public static function SignIn($data) {
        $time = time();

        $token = array(
            'exp'  => $time + (60*self::$minutes),
            'aud'  => self::Aud(),
            'data' => $data
        );

        return JWT::encode($token, self::$secret_key);
    }

    // Token validation
    public static function Check($token) {
        if(empty($token)) {
            throw new Exception("Invalid token supplied.");
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if($decode->aud !== self::Aud()) {
            throw new Exception("Invalid user logged in.");
        }
    }

    // Admin verification
    public static function CheckAdmin($token) {
        if(empty($token)) {
            throw new Exception("Invalid token supplied.");
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        //var_dump($decode);
        $datIno = $decode->data;
        if($datIno->rol != 'ADMIN') {
            throw new Exception("Sin permisos para el rol");
        }
    }

    // Get information from token
    public static function GetData($token) {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    // Determines user id
    public static function GetUserId($request) {
        $token = $request->getHeader('APP-TOKEN');
        if(isset($token[0])) {
            $token = $token[0];
        }

        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data->idUser;
    }

    // Token generation
    private static function Aud() {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}
