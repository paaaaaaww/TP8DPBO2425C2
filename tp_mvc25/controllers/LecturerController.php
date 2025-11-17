<?php
include_once("config.php");
include_once("models/Lecturer.php");
include_once("views/LecturerView.php");

// controller untuk mengelola data lecturer
class LecturerController
{
    private $lecturer;

    // konstruktor untuk inisialisasi model Lecturer
    function __construct()
    {
        $this->lecturer = new Lecturer(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }
    // fungsi untuk menampilkan data lecturer
    public function index()
    {
        $this->lecturer->open();
        $this->lecturer->getLecturer();

        // mengambil semua data lecturer
        $dataLecturer = [];
        while ($row = $this->lecturer->getResult()) {
            $dataLecturer[] = $row;
        }

        // menutup koneksi database
        $this->lecturer->close();

        // menampilkan data menggunakan view
        $view = new LecturerView();
        $view->render(["lecturer" => $dataLecturer]);
    }

    // fungsi untuk menambahkan data lecturer
    public function add()
    {
        if (isset($_POST['add'])) {

            $nama = $_POST['nama'];
            $nidn = $_POST['nidn'];
            $telepon = $_POST['telepon'];
            $tanggal_gabung = $_POST['tanggal_gabung'];

            // menyimpan data lecturer baru
            $this->lecturer->open();
            $this->lecturer->add($nama, $nidn, $telepon, $tanggal_gabung);
            $this->lecturer->close();

            // mengarahkan kembali ke halaman utama
            header("Location: lecturer.php");
            exit;
        }

        $this->index();   // kembali ke tampilan utama
    }

    // fungsi untuk mengedit data lecturer
    public function edit($id)
    {
        $this->lecturer->open();

        // jika submit update
        if (isset($_POST['submit'])) {

            $data = [
                "nama" => $_POST['nama'],
                "nidn" => $_POST['nidn'],
                "telepon" => $_POST['telepon'],
                "tanggal_gabung" => $_POST['tanggal_gabung']
            ];

            // update data lecturer
            $this->lecturer->update($id, $data); 
            $this->lecturer->close();

            // mengarahkan kembali ke halaman utama
            header("Location: lecturer.php");
            exit;
        }

        // ambil data lama untuk form
        $this->lecturer->getLecturerById($id);
        $lecturerData = $this->lecturer->getResult();
        $this->lecturer->close(); // menutup koneksi database

        // menampilkan form edit dengan data lama
        $view = new LecturerView();
        $view->renderEditForm($lecturerData);
    }

    // fungsi untuk menghapus data lecturer
    public function delete($id)
    {
        $this->lecturer->open();
        $this->lecturer->delete($id);
        $this->lecturer->close();

        // mengarahkan kembali ke halaman utama
        header("Location: lecturer.php");
        exit;
    }
}
?>
