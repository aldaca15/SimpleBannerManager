<?php
namespace App\Model;

use App\Lib\Response,
	App\Lib\Auth;

class AuthModel
{
    private $db;
    private $table = 'user';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function autenticar($userId, $password)
    {
		
        $usuario = $this->db->from($this->table)
						 ->where('email', $userId)
						 ->where('password', $password)
						 ->fetch();
        
        if(is_object($usuario)) {
			$nombre = explode(' ', $usuario->name)[0];
			
			$token = Auth::SignIn([
				'matricula' => $usuario->idUser,
				'name' => $nombre,
				'org' => $usuario->idOrganization,
				'role' => $usuario->role
			]);
			
			$this->response->result = $token;
			return $this->response->SetResponse(true);
		} else {
			return $this->response->SetResponse(false, "Credenciales no válidas");
		}
    }
}