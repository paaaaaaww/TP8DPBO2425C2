<?php
// kelas untuk menangani template HTML
class Template
{
    private $filename = ''; // nama file template
    private $content = ''; // isi file template

    function __construct($filename = '')
    {
        if (!file_exists($filename)) {
            die("Template file tidak ditemukan: $filename");
        }

        $this->filename = $filename;
        $this->content = file_get_contents($filename);
    }

    // mengganti placeholder dengan nilai tertentu
    function replace($placeholder, $value)
    {
        $this->content = str_replace($placeholder, $value, $this->content);
    }

    // menghapus placeholder yang tidak terpakai
    function clearUnusedPlaceholders()
    {
        // Menghapus placeholder seperti {{PLACEHOLDER}}
        $this->content = preg_replace('/\{\{[A-Z0-9_]+\}\}/', '', $this->content);

        // Menghapus placeholder seperti DATA_TABLE, DATA_FORM, dll.
        $this->content = preg_replace('/DATA_[A-Z0-9_]+/', '', $this->content);
    }
    // menampilkan isi template
    function write()
    {
        $this->clearUnusedPlaceholders();
        echo $this->content;
    }
    // mendapatkan isi template sebagai string
    function getContent()
    {
        $this->clearUnusedPlaceholders();
        return $this->content;
    }
}
