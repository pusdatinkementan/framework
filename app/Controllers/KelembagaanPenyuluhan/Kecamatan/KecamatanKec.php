<?php

namespace App\Controllers\KelembagaanPenyuluhan\Kecamatan;

use App\Controllers\BaseController;
use App\Models\KelembagaanPenyuluhan\Kecamatan\KecamatanKecModel;

class KecamatanKec extends BaseController
{
    public function kecamatan()
    {
        $get_param = $this->request->getGet();

        $kode_kec = $get_param['kode_kec'];
        $kec_model = new KecamatanKecModel;
        $bpp_data = $kec_model->getKecTotal($kode_kec);

        $data = [
            //'jumpns' => $kec_data['jumpns'],
            'nama_kecamatan' => $bpp_data['nama_kec'],
            'tabel_data' => $bpp_data['table_data'],
            'title' => 'Kecamatan',
            'name' => 'Kecamatan'
        ];

        return view('KelembagaanPenyuluhan/Kecamatan/kecamatankec', $data);
    }
}
