<?php

namespace App\Models\KelembagaanPenyuluhan\Desa;

use CodeIgniter\Model;
use \Config\Database;

class PosluhdesKecModel extends Model
{
    protected $table      = 'simluhtan';
    //protected $primaryKey = 'id';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    //protected $allowedFields = ['nama', 'alamat', 'telpon'];


    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getPosluhdesKecTotal($kode_kec)
    {
        $db = Database::connect();
        $query = $db->query("select deskripsi as nama_kec from tbldaerah where id_daerah='$kode_kec'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_kec FROM tb_posluhdes where kode_kec ='$kode_kec'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select * , b.nm_desa, c.nama as penyuluh_swadaya, a.nama, a.alamat 
                                from tb_posluhdes a
                                left join tbldesa b on a.kode_desa=b.id_desa
                                left join tbldasar_swa c on a.penyuluh_swadaya=c.id_swa 
                                where kode_kec='$kode_kec'
                                order by a.nama, a.kode_desa");
        $results = $query3->getResultArray();

        $data =  [
            'jum_kec' => $row2->jum_kec,
            'nama_kec' => $row->nama_kec,
            'table_data' => $results,
        ];

        return $data;
    }
}
