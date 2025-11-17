<?php
include_once("views/Template.php");
include_once("models/DB.php"); // include database model
include_once("controllers/LecturerController.php"); // include controller lecturer

$lecturer = new LecturerController();
// jika form tambah lecturer disubmit
if (isset($_POST['add'])) {

    $lecturer->add();
    exit;
}

// jika form hapus lecturer disubmit
else if (!empty($_GET['id_hapus'])) {

    $lecturer->delete($_GET['id_hapus']);
    exit;
}

// jika form edit lecturer disubmit
else if (!empty($_GET['id_edit'])) {

    $lecturer->edit($_GET['id_edit']);
    exit;
}

// jika form tampil utama lecturer
else {
    $lecturer->index();
}
