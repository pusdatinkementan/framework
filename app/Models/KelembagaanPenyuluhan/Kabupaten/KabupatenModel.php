<?php

namespace App\Models\KelembagaanPenyuluhan\Kabupaten;

use CodeIgniter\Model;
use \Config\Database;

class KabupatenModel extends Model
{
    //protected $table      = 'penyuluh';
    //protected $primaryKey = 'id';


    //protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    //protected $allowedFields = ['nama', 'alamat', 'telpon'];


    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getKabTotal($kode_kab)
    {
        $db = Database::connect();
        $query = $db->query("select nama_dati2 as nama_kab from tbldati2 where id_dati2='$kode_kab'");
        $row   = $query->getRow();
        $query2 = $db->query("SELECT count(idpos) as jum_des FROM tb_posluhdes where kode_kab ='$kode_kab'");
        $row2   = $query2->getRow();
        $query3  = $db->query("select a.alamat, a.ketua, a.tgl_update, a.nama_bapel, b.jumpns, c.jumthl, d.jumswa, e.jumpok, f.jumgap, g.jumkep,
                                    case a.nama_bapel 
                                    when '10' then 'Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan'
                                    when '20' then 'Badan Pelaksana Penyuluhan'
                                    when '31' then deskripsi_lembaga_lain
                                    when '32' then deskripsi_lembaga_lain
                                    when '33' then deskripsi_lembaga_lain
                                    else '' end nama_bapel
                                from tblbapel a
                                left join (select status, satminkal, count(id) as jumpns from tbldasar GROUP BY satminkal, status) b on a.kabupaten=b.satminkal and status !='1' and status !='2' and status !='3'
                                left join (select satminkal, count(id_thl) as jumthl from tbldasar_thl GROUP BY satminkal) c on a.kabupaten=c.satminkal
                                left join (select satminkal, count(id_swa) as jumswa from tbldasar_swa GROUP BY satminkal) d on a.kabupaten=d.satminkal
                                left join (select kode_kab, count(id_poktan) as jumpok from tb_poktan GROUP BY kode_kab) e on a.kabupaten=e.kode_kab
                                left join (select kode_kab, count(id_gap) as jumgap from tb_gapoktan GROUP BY kode_kab) f on a.kabupaten=f.kode_kab
                                left join (select kode_kab, count(id_kep) as jumkep from tb_kep GROUP BY kode_kab) g on a.kabupaten=g.kode_kab
                                where kabupaten='$kode_kab'
                                ");
        $results = $query3->getResultArray();

        $data =  [
            'jum_des' => $row2->jum_des,
            'nama_kab' => $row->nama_kab,
            'table_data' => $results,
        ];

        return $data;
    }
}
