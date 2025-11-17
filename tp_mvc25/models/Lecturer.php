<?php
// model untuk mengelola data dosen
class Lecturer extends DB
{
    // ambil semua data dosen
    function getLecturer()
    {
        $query = "SELECT * FROM lecturers";
        return $this->execute($query);
    }
    // ambil data dosen berdasarkan id
    function getLecturerById($id)
    {
        $query = "SELECT * FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }
    // tambah dosen baru
    public function add($nama, $nidn, $telepon, $tanggal_gabung)
    {
        $query = "INSERT INTO lecturers (nama, nidn, telepon, tanggal_gabung)
                VALUES ('$nama', '$nidn', '$telepon', '$tanggal_gabung')";

        return $this->execute($query);
    }
    // edit dosen
    function update($id, $data)
    {
        $nama = $data['nama'];
        $nidn = $data['nidn'];
        $telepon = $data['telepon'];
        $tanggal = $data['tanggal_gabung'];
        // update query
        $query = "UPDATE lecturers 
                  SET nama = '$nama',
                      nidn = '$nidn',
                      telepon = '$telepon',
                      tanggal_gabung = '$tanggal'
                  WHERE id = $id";
        // eksekusi query
        return $this->execute($query);
    }
    // hapus dosen
    function delete($id)
    {
        $query = "DELETE FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }
}
