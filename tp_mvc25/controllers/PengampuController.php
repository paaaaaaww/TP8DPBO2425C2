<?php
include_once("config.php");
include_once("models/Pengampu.php");
include_once("models/Lecturer.php");
include_once("models/MataKuliah.php");
include_once("views/PengampuView.php");

// controller untuk mengelola data pengampu
class PengampuController
{
    private $pengampu;
    private $lecturer;
    private $matkul;

    // konstruktor untuk inisialisasi model Pengampu, Lecturer, dan MataKuliah
    function __construct()
    {
        $this->pengampu = new Pengampu(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );

        $this->lecturer = new Lecturer(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );

        $this->matkul = new MataKuliah(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }

    // fungsi untuk menampilkan data pengampu beserta data lecturer dan mata kuliah
    public function index()
    {
        $this->pengampu->open();
        $this->lecturer->open();
        $this->matkul->open();

        $this->pengampu->getPengampu();
        $this->lecturer->getLecturer();
        $this->matkul->getMataKuliah();

        $data = [
            "pengampu" => [],
            "lecturer" => [],
            "matkul" => []
        ];

        while ($row = $this->pengampu->getResult()) {
            $data["pengampu"][] = $row;
        }

        while ($row = $this->lecturer->getResult()) {
            $data["lecturer"][] = $row;
        }

        while ($row = $this->matkul->getResult()) {
            $data["matkul"][] = $row;
        }

        $this->pengampu->close();
        $this->lecturer->close();
        $this->matkul->close();

        $view = new PengampuView();
        $view->render($data);
    }

    // fungsi untuk menambahkan data pengampu
    public function add()
    {
        // jika user menekan tombol add
        if (isset($_POST['add'])) {
            $id_dosen = $_POST['id_dosen'];
            $id_matkul = $_POST['id_matkul'];
            $semester = $_POST['semester'];
            $tahun_ajaran = $_POST['tahun_ajaran'];

            // menyimpan data pengampu baru
            $this->pengampu->open();
            $this->pengampu->add($id_dosen, $id_matkul, $semester, $tahun_ajaran);
            $this->pengampu->close();

            header("Location: pengampu.php");
            exit;
        }

        $this->index(); // jika tidak submit maka tampilkan halaman index
    }


    // fungsi untuk mengedit data pengampu
    public function edit($id)
    {
        // buka koneksi ke tabel pengampu
        $this->pengampu->open();

        if (isset($_POST['submit'])) {

        // Ambil data dari form
        $id = $_GET['id_edit']; 
        $id_dosen = $_POST['id_dosen'];
        $id_matkul = $_POST['id_matkul'];
        $semester = $_POST['semester'];
        $tahun_ajaran = $_POST['tahun_ajaran'];

        // Update data pengampu
        $this->pengampu->update($id, $id_dosen, $id_matkul, $semester, $tahun_ajaran);

            // Tutup koneksi dan redirect
            $this->pengampu->close();
            header("Location: pengampu.php");
            exit;
        }

        // ambil data pengampu berdasarkan id
        $data['pengampu'] = $this->pengampu->getPengampuById($id);
        $this->pengampu->close();

        // buka koneksi dosen dan mata kuliah
        $this->lecturer->open();
        $this->matkul->open();

        $this->lecturer->getLecturer();
        $this->matkul->getMataKuliah();

        // simpan hasil query dosen
        $data["lecturer"] = [];
        while ($row = $this->lecturer->getResult()) {
            $data["lecturer"][] = $row;
        }

        // simpan hasil query matkul
        $data["matkul"] = [];
        while ($row = $this->matkul->getResult()) {
            $data["matkul"][] = $row;
        }

        $this->lecturer->close();
        $this->matkul->close();

        // render form edit
        $view = new PengampuView();
        $view->renderEditForm($data);
    }

    // fungsi untuk menghapus data pengampu
    public function delete($id)
    {
        $this->pengampu->open();
        $this->pengampu->delete($id);
        $this->pengampu->close();

        header("Location: pengampu.php");
        exit;
    }
}
?>
