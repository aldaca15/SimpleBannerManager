<?php
namespace App\Model;

use App\Lib\Response;

class MediaModel
{
    private $db;
    private $table = 'media';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }

    public function listAll()
    {
        $data = $this->db->from($this->table)->groupBy('idBanner')->orderBy('idBanner DESC')
						 ->fetchAll();

        return [
            'data'  => $data
        ];
    }

    public function get($id)
    {
        return $this->db->from($this->table)->where('idBanner', $id)->orderBy('idMedia DESC')
						->fetch();
    }

	public function update($data, $id)
    {

		/*if(isset($data['password'])) {
			$data['password'] = md5($data['password']);
		}*/
        $media = $this->db->from($this->table)->where('idBanner', $id)->orderBy('idMedia DESC')->fetch();
        $this->db->update($this->table, array('viewCount' => ($media->viewCount)+1))->where('idMedia', $media->idMedia)->execute();

        return $this->response->SetResponse(true);
    }

	public function post($data)
    {
        $dataProvider['resource'] = $data['resource'];
        $dataProvider['destinationURL'] = $data['destinationURL'];
        $dataProvider['idBanner'] = $data['idBanner'];
        $dataProvider['width'] = $data['width'];
        $dataProvider['height'] = $data['height'];
        $dataProvider['viewCount'] = 0;

        $productId = $this->db->insertInto($this->table, $dataProvider)
            ->execute();

        return $this->response->SetResponse(true);
    }
}
