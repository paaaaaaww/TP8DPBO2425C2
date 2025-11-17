<?php
include_once("views/Template.php");
include_once("models/DB.php"); // include database model
include_once("controllers/PengampuController.php"); // include controller pengampu

$pengampu = new PengampuController();
// jika form tambah pengampu disubmit
if (isset($_POST['add'])) {

    $pengampu->add();
    exit;
}

// jika form hapus pengampu disubmit
else if (!empty($_GET['id_hapus'])) {

    $pengampu->delete($_GET['id_hapus']);
    exit;
}

// jika form edit pengampu disubmit
else if (!empty($_GET['id_edit'])) {

    $pengampu->edit($_GET['id_edit']);
    exit;
}

// jika form tampil utama pengampu disubmit
else {
    $pengampu->index();
}
