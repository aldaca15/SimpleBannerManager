<?php
namespace App\Model;

use App\Lib\Response;

class BannerModel
{
    private $db;
    private $table = 'banner';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function listar()
    {
        $data = $this->db->from($this->table)
						 ->fetchAll();
        
        $total = $this->db->from($this->table)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        
        return [
            'data'  => $data,
            'total' => $total
        ];
    }
    
    public function obtener($id)
    {
        return $this->db->from($this->table)->where('idBanner', $id)
						->fetch();
    }
	
	public function actualizar($data, $id)
    {
		/*if(isset($data['password'])) {
			$data['password'] = md5($data['password']);
		}*/

		$this->db->update($this->table)->set('viewCount', +1)->where('idBanner', $id)->execute();
        //$this->db->update($this->table, $data, $id)->execute();

        return $this->response->SetResponse(true);
    }
}