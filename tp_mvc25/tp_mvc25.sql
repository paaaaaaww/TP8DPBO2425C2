CREATE DATABASE tp_mvc25_2;
USE tp_mvc25_2;

-- Tabel utama (Dosen)
CREATE TABLE lecturers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  nidn VARCHAR(20) NOT NULL,
  telepon VARCHAR(20),
  tanggal_gabung DATE
);




-- Tabel tambahan 1: Mata Kuliah
CREATE TABLE mata_kuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_matkul VARCHAR(100) NOT NULL,
  kode_matkul VARCHAR(20) NOT NULL,
  sks INT NOT NULL
);

-- Tabel tambahan 2: Pengampu (relasi dosen - mata kuliah)
CREATE TABLE pengampu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_dosen INT,
  id_matkul INT,
  semester VARCHAR(10),
  tahun_ajaran VARCHAR(20),
  FOREIGN KEY (id_dosen) REFERENCES lecturers(id) ON DELETE CASCADE,
  FOREIGN KEY (id_matkul) REFERENCES mata_kuliah(id) ON DELETE CASCADE
);

-- Data Dummy
-- Dosen
INSERT INTO lecturers (nama, nidn, telepon, tanggal_gabung) VALUES
('Yudi Wibisono', '123456789', '081234567890', '2015-02-15'),
('Rosa Arianto', '987654321', '082134567891', '2013-07-01'),
('Rani Maharani', '456789123', '083145678912', '2016-01-10');

-- mata kuliah
INSERT INTO mata_kuliah (nama_matkul, kode_matkul, sks) VALUES
('Pemrograman Web', 'IK101', 4),
('Basis Data', 'IK102', 4),
('Struktur Data', 'IK103', 4),
('Jaringan Komputer', 'IK104', 4),
('Desain Pemrograman Berdasarkan Objek', 'IK105', 4),
('Seminar Pendidikan Agama Islam', 'IK106', 2);


-- Pengampu
INSERT INTO pengampu (id_dosen, id_matkul, semester, tahun_ajaran) VALUES
(1, 1, 'Genap', '2024/2025'),
(1, 2, 'Ganjil', '2023/2024'),
(2, 3, 'Genap', '2024/2025'),
(3, 4, 'Ganjil', '2024/2025');