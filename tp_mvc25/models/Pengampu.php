<?php
include_once("models/DB.php"); // pastikan untuk meng-include kelas DB

class Pengampu extends DB
{
    // ambil semua data pengampu (join dengan dosen & matkul)
    function getPengampu()
    {
        // query dengan JOIN untuk menggabungkan tabel pengampu, lecturers, dan mata_kuliah
        $query = "SELECT 
                    pengampu.id, 
                    lecturers.nama AS nama_dosen, 
                    mata_kuliah.nama_matkul AS nama_matkul,
                    pengampu.semester, 
                    pengampu.tahun_ajaran
                FROM pengampu
                JOIN lecturers ON pengampu.id_dosen = lecturers.id
                JOIN mata_kuliah ON pengampu.id_matkul = mata_kuliah.id";

        return $this->execute($query);
    }


    // tambah pengampu
    public function add($id_dosen, $id_matkul, $semester, $tahun_ajaran)
    {
        $query = "INSERT INTO pengampu (id_dosen, id_matkul, semester, tahun_ajaran)
                  VALUES ('$id_dosen', '$id_matkul', '$semester', '$tahun_ajaran')";
        return $this->execute($query);
    }

    // Hapus pengampu berdasarkan id
    function delete($id)
    {
        $query = "DELETE FROM pengampu WHERE id = $id";
        return $this->execute($query);
    }

    // ambil 1 baris data pengampu (untuk form edit)
    function getPengampuById($id)
    {
        $query = "SELECT * FROM pengampu WHERE id = $id";
        $result = $this->execute($query);
        return mysqli_fetch_assoc($result); 
    }

    // update data pengampu
    function update($id, $id_dosen, $id_matkul, $semester, $tahun_ajaran)
    {
        $query = "UPDATE pengampu 
                  SET id_dosen = '$id_dosen',
                      id_matkul = '$id_matkul',
                      semester = '$semester',
                      tahun_ajaran = '$tahun_ajaran'
                  WHERE id = $id";
    
        return $this->execute($query);  
    }
}
?>
