<?php

namespace App\Controllers\KelembagaanPenyuluhan\Desa;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Desa\DesaKecModel;
use App\Models\KelembagaanPenyuluhan\Desa\PosluhdesKecModel;

class DesaKec extends BaseController
{
    public function desa()
    {
        $get_param = $this->request->getGet();

        $kode_bpp = $get_param['kode_bpp'];
        $desa_model = new DesaKecModel;
        $desa_data = $desa_model->getDesaTotal($kode_bpp);

        $data = [
            'jum_des' => $desa_data['jum_des'],
            'nama_bp3k' => $desa_data['nama_kec'],
            'tabel_data' => $desa_data['table_data'],
            'title' => 'Desa',
            'name' => 'Desa'
        ];

        return view('KelembagaanPenyuluhan/Desa/desakec', $data);
    }

    public function listdesa()
    {

        $get_param = $this->request->getGet();

        $kode_kec = $get_param['kode_kec'];
        $posluhdes_model = new PosluhdesKecModel;
        $posluhdes_data = $posluhdes_model->getPosluhdesKecTotal($kode_kec);

        $data = [
            'jum_kec' => $posluhdes_data['jum_kec'],
            'nama_kecamatan' => $posluhdes_data['nama_kec'],
            'tabel_data' => $posluhdes_data['table_data'],
            'title' => 'Daftar Posluhdes',
            'name' => 'Posluhdes'
        ];

        return view('KelembagaanPenyuluhan/Desa/daftar_posluhdes_kec', $data);
    }
}
