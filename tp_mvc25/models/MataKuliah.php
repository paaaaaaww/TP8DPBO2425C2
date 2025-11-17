<?php
// model untuk mengelola data mata kuliah
class MataKuliah extends DB
{
    // ambil semua mata kuliah
    function getMataKuliah()
    {
        $query = "SELECT * FROM mata_kuliah";
        return $this->execute($query);
    }
    // ambil mata kuliah berdasarkan id
    function getMataKuliahById($id)
    {
        $query = "SELECT * FROM mata_kuliah WHERE id = $id";
        return $this->execute($query);
    }
    // tambah mata kuliah
    public function add($nama, $kode, $sks)
    {
        $query = "INSERT INTO mata_kuliah (nama_matkul, kode_matkul, sks)
                VALUES ('$nama', '$kode', '$sks')";
        return $this->execute($query);
    }
    // edit mata kuliah
    function update($id, $nama, $kode, $sks)
    {
        $query = "UPDATE mata_kuliah 
                SET nama_matkul='$nama',
                    kode_matkul='$kode',
                    sks=$sks
                WHERE id=$id";

        return $this->execute($query);
    }
    // hapus mata kuliah
    function delete($id)
    {
        $query = "DELETE FROM mata_kuliah WHERE id = $id";
        return $this->execute($query);
    }
}
