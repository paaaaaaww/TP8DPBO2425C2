<?php
class DB {
    private $db_host = "";
    private $db_user = "";
    private $db_pass = "";
    private $db_name = "";
    private $db_link;
    private $result;

    function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    // buka koneksi
    function open()
    {
        $this->db_link = mysqli_connect(
            $this->db_host, 
            $this->db_user, 
            $this->db_pass, 
            $this->db_name
        );

        if (!$this->db_link) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // eksekusi query
    function execute($query)
    {
        $this->result = mysqli_query($this->db_link, $query);

        if (!$this->result) {
            die("Query Error: " . mysqli_error($this->db_link) . "<br>Query: <pre>$query</pre>");
        }

        return $this->result;
    }

    // ambil 1 baris hasil (selalu associative)
    function getResult()
    {
        return mysqli_fetch_assoc($this->result);
    }

    // ambil semua hasil (lebih rapi)
    function getAll()
    {
        $rows = [];
        while ($row = mysqli_fetch_assoc($this->result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    // tutup koneksi
    function close()
    {
        mysqli_close($this->db_link);
    }
}
