<?php
// view untuk menampilkan data dosen
class LecturerView
{
    // halaman utama
    public function render($data)
    {
        // membuat baris tabel dari data dosen
        $no = 1;
        $rows = "";

        // looping data dosen
        foreach ($data["lecturer"] as $val) {
            // membuat baris tabel
            $rows .= "
                <tr>
                    <td>$no</td>
                    <td>{$val['nama']}</td>
                    <td>{$val['nidn']}</td>
                    <td>{$val['telepon']}</td>
                    <td>{$val['tanggal_gabung']}</td>
                    <td>
                        <a href='lecturer.php?id_edit={$val['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='lecturer.php?id_hapus={$val['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                    </td>
                </tr>
            ";
            $no++;
        }
        // render template
        $tpl = new Template("templates/lecturer.html");
        $tpl->replace("JUDUL", "Lecturer");
        $tpl->replace("DATA_TABEL", $rows);
        $tpl->write();
    }

    // halaman edit form
    public function renderEditForm($data)
    {
        // render untuk form edit
        $tpl = new Template("templates/lecturerEdit.html");
        // mengganti placeholder dengan data dosen yang akan diedit
        $tpl->replace("ID_VALUE", $data['id']);
        $tpl->replace("NAMA_VALUE", $data['nama']);
        $tpl->replace("NIDN_VALUE", $data['nidn']);
        $tpl->replace("TELEPON_VALUE", $data['telepon']);
        $tpl->replace("TANGGAL_VALUE", $data['tanggal_gabung']);

        $tpl->write();
    }
}
