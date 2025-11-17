<?php
include_once("config.php");
include_once("models/MataKuliah.php");
include_once("models/Lecturer.php");
include_once("views/MataKuliahView.php");

// controller untuk mengelola data mata kuliah
class MataKuliahController
{
  private $mataKuliah;
  private $lecturer;

  //konstruktor untuk inisialisasi model MataKuliah dan Lecturer
  function __construct()
  {
    $this->mataKuliah = new MataKuliah(
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
  }

  // fungsi untuk menampilkan data mata kuliah beserta data lecturer
  public function index()
  {
    $this->mataKuliah->open();
    $this->lecturer->open();

    $this->mataKuliah->getMataKuliah();
    $this->lecturer->getLecturer();

    // mengambil semua data mata kuliah dan lecturer
    $data = [
      'mataKuliah' => [],
      'lecturer' => []
    ];

    while ($row = $this->mataKuliah->getResult()) {
      $data['mataKuliah'][] = $row;
    }

    while ($row = $this->lecturer->getResult()) {
      $data['lecturer'][] = $row;
    }

    $this->mataKuliah->close();
    $this->lecturer->close();
    // menampilkan data menggunakan view
    $view = new MataKuliahView();
    $view->render($data);
  }

  // fungsi untuk menambahkan data mata kuliah
  public function add()
  {
    // jika user menekan tombol add
      if (isset($_POST['add'])) {

          $nama = $_POST['nama_matkul'];
          $kode = $_POST['kode_matkul'];
          $sks  = $_POST['sks'];

          // menyimpan data mata kuliah baru
          $this->mataKuliah->open();
          $this->mataKuliah->add($nama, $kode, $sks);
          $this->mataKuliah->close();

          // mengarahkan kembali ke halaman utama
          header("Location: mataKuliah.php");
          exit;
      }

      $this->index();
  }

  // fungsi untuk mengedit data mata kuliah
  public function edit($id)
  {
      $this->mataKuliah->open();

      // ika user menekan tombol submit update
      if (isset($_POST['submit'])) {

          $nama_matkul = $_POST['nama_matkul'];
          $kode_matkul = $_POST['kode_matkul'];
          $sks = $_POST['sks'];

          $this->mataKuliah->update($id, $nama_matkul, $kode_matkul, $sks);
          $this->mataKuliah->close();

          header("Location: mataKuliah.php");  // mengarahkan kembali ke halaman utama
          exit;
      }

      // jika belum submit maka ambil data lama
      $this->mataKuliah->getMataKuliahById($id);
      $data = $this->mataKuliah->getResult();
      $this->mataKuliah->close();

      // menampilkan form edit dengan data lama
      $view = new MataKuliahView();
      $view->renderEditForm($data);
  }

  // fungsi untuk menghapus data mata kuliah
  public function delete($id)
  {
    // menghapus data mata kuliah berdasarkan id
    $this->mataKuliah->open();
    $this->mataKuliah->delete($id);
    $this->mataKuliah->close();

    header("Location: mataKuliah.php");
    exit;
  }
}
?>
