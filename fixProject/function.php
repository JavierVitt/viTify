<?php


$conn = mysqli_connect("localhost", "root", "", "tekweb");

class Queue
{
    public $data = array();
    public $size = 0;

    function enqueue($link)
    {
        $this->size++;
        // array_push(self::$data, $link);
        $this->data[] = $link;
    }

    function dequeue()
    {
        if (!$this->isEmpty()) {
            $this->size -= 1;
            return array_shift($this->data);
        } else {
            return null;
        }
    }

    function isEmpty()
    {
        if ($this->size === 0) {
            return true;
        } else {
            return false;
        }
    }
    function printQueue()
    {
        if ($this->isEmpty()) {
            return "Antrian kosong.";
        } else {
            return "Isi dari antrian:\n" . print_r($this->data, true);
        }
    }
}

// if($_SESSION["que"]==false){
//     // $queue = new Queue();
// $queue = Queue::getInstance();
//     $_SESSION["que"] = true;
//     echo "<script>alert('baru')</script>";
// }



function out()
{
    global $conn;

    $sql = "SELECT link FROM LAGU";
    $result = $conn->query($sql);

    $songs = [];

    if ($result->num_rows > 0) {
        // Mengambil setiap baris sebagai objek
        while ($row = $result->fetch_assoc()) {
            // Tambahkan link lagu ke array
            $songs[] = $row['link'];
        }
    } else {
        echo "0 results";
    }
    echo json_encode($songs);
}


function query($syntax)
{
    global $conn;

    $result = mysqli_query($conn, $syntax);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function signUp($syntax)
{
    global $conn;

    mysqli_query($conn, $syntax);

    return mysqli_affected_rows($conn);
}
function newPlaylist($id, $data)
{
    global $conn;

    $namaPlaylist = $data["nama"];
    $descPlaylist = $data["deskripsi"];
    $syntaxAddPlaylist = "INSERT INTO PLAYLIST VALUES('',$id,'$namaPlaylist','$descPlaylist')";

    mysqli_query($conn, $syntaxAddPlaylist);

    return mysqli_affected_rows($conn);
}
function deleteUserFromPlaylist($id)
{
    global $conn;

    $syn = "DELETE FROM PLAYLIST WHERE id_user = $id";
    mysqli_query($conn, $syn);

    return mysqli_affected_rows($conn);
}
function deleteUser($id)
{
    global $conn;

    $syn = "DELETE FROM USER WHERE id_user = $id";
    mysqli_query($conn, $syn);

    return mysqli_affected_rows($conn);
}
function addLagu($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $penyanyi = $data["penyanyi"];
    $genre = $data["genre"];
    $tanggal = $data["tanggal"];
    $lagus = $data["lagu"];
    $lagu = ambilNilaiAntara($lagus, 'be/', '?');

        if ($lagu == '') {
            $lagu = ambilNilaiSetelah($lagus, '=');
        }
    
        if ($lagu != '') {
            $syn = "INSERT INTO LAGU (judul_lagu, penyanyi, genre, tanggal_rilis, link) VALUES ('$nama', '$penyanyi', '$genre', '$tanggal', '$lagu')";
            mysqli_query($conn, $syn);
    
            return mysqli_affected_rows($conn);
        }
}
function deleteLagu($id)
{
    global $conn;

    $syn1 = "DELETE FROM TRACK_LAGU WHERE id_lagu = $id";
    mysqli_query($conn, $syn1);

    $syn = "DELETE FROM LAGU WHERE id_lagu = $id";

    mysqli_query($conn, $syn);

    return mysqli_affected_rows($conn);
}
function deletePlaylist($id)
{
    global $conn;

    $syn1 = "DELETE FROM TRACK_LAGU WHERE id_playlist = $id";
    mysqli_query($conn, $syn1);

    $syn = "DELETE FROM PLAYLIST WHERE id_playlist = $id";
    mysqli_query($conn, $syn);

    return mysqli_affected_rows($conn);
}
function addLaguToPlaylist($idUser, $idLagu, $idPlaylist)
{
    global $conn;

    $syn = "INSERT INTO TRACK_LAGU VALUES('',$idUser,$idPlaylist,$idLagu)";

    mysqli_query($conn, $syn);

    return mysqli_affected_rows($conn);
}
function cekLagu($data)
{
    global $conn;

    $nama = $data["nama"];
    $penyanyi = $data["penyanyi"];
    $genre = $data["genre"];
    $tanggal = $data["tanggal"];
    $lagus = $data["lagu"];
    $lagu = ambilNilaiAntara($lagus, 'be/', '?');

        if ($lagu == '') {
            $lagu = ambilNilaiSetelah($lagus, '=');
        }
    
        if ($lagu != '') {
            $syn = "INSERT INTO CEK (judul_laguc, penyanyic, genrec, tanggal_rilisc, linkc) VALUES ('$nama', '$penyanyi', '$genre', '$tanggal', '$lagu')";
            mysqli_query($conn, $syn);
    
            return mysqli_affected_rows($conn);
        }
    
}
function ambilNilaiAntara($kalimat, $karakterAwal, $karakterAkhir)
{
    $posisiAwal = strpos($kalimat, $karakterAwal);
    if ($posisiAwal === false) {
        return '';
    }

    $posisiAwal += strlen($karakterAwal);
    $posisiAkhir = strpos($kalimat, $karakterAkhir, $posisiAwal);
    if ($posisiAkhir === false) {
        return '';
    }

    return substr($kalimat, $posisiAwal, $posisiAkhir - $posisiAwal);
}
function ambilNilaiSetelah($kalimat, $karakterPemisah)
{
    $posisiPemisah = strpos($kalimat, $karakterPemisah);
    if ($posisiPemisah === false) {
        return '';
    }

    return substr($kalimat, $posisiPemisah + 1);
}
