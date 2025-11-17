<?php
// view untuk menampilkan data mata kuliah
class MataKuliahView
{
    public function render($data)
    {
        // membuat baris tabel dari data mata kuliah
        $no = 1;
        $dataMatkul = "";

        // Ambil hanya array matkul
        foreach ($data["mataKuliah"] as $val) {

            $id = $val['id'];
            $nama_matkul = $val['nama_matkul'];
            $kode_matkul = $val['kode_matkul'];
            $sks = $val['sks'];

            $dataMatkul .= "
                <tr>
                    <td>$no</td>
                    <td>$nama_matkul</td>
                    <td>$kode_matkul</td>
                    <td>$sks</td>
                    <td>
                        <a href='mataKuliah.php?id_edit=$id' class='btn btn-warning'>Edit</a>
                        <a href='mataKuliah.php?id_hapus=$id' class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>
            ";
            $no++;
        }
        // render untuk template
        $tpl = new Template("templates/mataKuliah.html"); 
        $tpl->replace("JUDUL", "Mata Kuliah");
        $tpl->replace("DATA_TABEL", $dataMatkul);
        $tpl->write();
    }
    // halaman edit form
    public function renderEditForm($data)
    {
        $template = new Template("templates/mataKuliahEdit.html"); // render untuk form edit

        $template->replace("ID_VALUE", $data['id']);
        $template->replace("NAMA_VALUE", $data['nama_matkul']);
        $template->replace("KODE_VALUE", $data['kode_matkul']);
        $template->replace("SKS_VALUE", $data['sks']);

        $template->write();
    }
}
