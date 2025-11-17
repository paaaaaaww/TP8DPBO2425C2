<?php
include_once("views/Template.php"); 
include_once("models/DB.php"); // include database model
include_once("controllers/MataKuliahController.php"); // include controller mata kuliah

$mataKuliah = new MataKuliahController();
// jika form tambah mata kuliah disubmit
if (isset($_POST['add'])) {

    $mataKuliah->add();
    exit;
}

// jika form hapus mata kuliah disubmit
else if (!empty($_GET['id_hapus'])) {

    $mataKuliah->delete($_GET['id_hapus']);
    exit;
}

// jika form edit mata kuliah disubmit
else if (!empty($_GET['id_edit'])) {

    $mataKuliah->edit($_GET['id_edit']);
    exit;
}

// jika form tampil utama mata kuliah
else {
    $mataKuliah->index();
}
