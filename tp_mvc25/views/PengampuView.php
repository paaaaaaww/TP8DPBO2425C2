<?php
// view untuk menampilkan data pengampu
class PengampuView
{
    // halaman utama
    public function render($data)
    {
        $no = 1;
        $rows = "";

        foreach ($data["pengampu"] as $val) { // looping data pengampu

            $rows .= "
                <tr>
                    <td>$no</td>
                    <td>{$val['nama_dosen']}</td>
                    <td>{$val['nama_matkul']}</td>
                    <td>{$val['semester']}</td>
                    <td>{$val['tahun_ajaran']}</td>
                    <td>
                        <a href='pengampu.php?id_edit={$val['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='pengampu.php?id_hapus={$val['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                    </td>
                </tr>
            ";
            $no++;
        }

        // dropdown dosen
        $optDosen = "";
        foreach ($data["lecturer"] as $lec) {
            $optDosen .= "<option value='{$lec['id']}'>{$lec['nama']}</option>";
        }

        // dropdown matkul
        $optMatkul = "";
        foreach ($data["matkul"] as $mk) {
            $optMatkul .= "<option value='{$mk['id']}'>{$mk['nama_matkul']}</option>";
        }

        $tpl = new Template("templates/pengampu.html"); // render template pengampu
        $tpl->replace("DATA_TABEL", $rows);
        $tpl->replace("DATA_DOSEN", $optDosen);
        $tpl->replace("DATA_MATKUL", $optMatkul);
        $tpl->write();
    }
    // halaman edit form
    public function renderEditForm($data)
    {
        $tpl = new Template("templates/PengampuEdit.html"); // render untuk form edit

        // Isi dropdown dosen
        $optionsDosen = "";
        foreach ($data['lecturer'] as $d) {
            $selected = ($d['id'] == $data['pengampu']['id_dosen']) ? "selected" : "";
            $optionsDosen .= "<option value='{$d['id']}' $selected>{$d['nama']}</option>";
        }

        // Isi dropdown mata kuliah
        $optionsMatkul = "";
        foreach ($data['matkul'] as $m) {
            $selected = ($m['id'] == $data['pengampu']['id_matkul']) ? "selected" : "";
            $optionsMatkul .= "<option value='{$m['id']}' $selected>{$m['nama_matkul']}</option>";

        }
        // ganti placeholder dengan data pengampu
        $tpl->replace("ID_VALUE", $data['pengampu']['id']);
        $tpl->replace("DATA_DOSEN", $optionsDosen);
        $tpl->replace("DATA_MATKUL", $optionsMatkul);
        $tpl->replace("SEMESTER_VALUE", $data['pengampu']['semester']);
        $tpl->replace("TAHUN_VALUE", $data['pengampu']['tahun_ajaran']);
    
        $tpl->write();
    }
}
