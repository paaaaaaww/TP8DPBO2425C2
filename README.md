# TP8DPBO2425C2
Saya Fauzia Rahma Nisa mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemrograman Berdasarkan Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

1. Desain Program
   Program ini dibangun menggunakan pola MVC (Model–View–Controller) yang mengelola tiga entitas utama: Lecturer, Mata Kuliah, dan Pengampu.
   
   lecturer:
   - id INT
   - nama VARCHAR(100)
   - nidn VARCHAR(20)
   - telepon VARCHAR(20)
   - tanggal_gabung DATE

   mata_kuliah:
   - id INT
   - nama_matkul VARCHAR(100)
   - kode_matkul VARCHAR(20)
   - sks INT
     
   pengampu:
   - id INT
   - id_dosen INT
   - id_matkul INT
   - semester VARCHAR(10)
   - tahun_ajaranVARCHAR(20)
     
   Relasi :
   - 1 dosen → banyak pengampu
   - 1 mata kuliah → banyak pengampu
   - Pengampu mengikat relasi many-to-many antara dosen dan mata kuliah.
