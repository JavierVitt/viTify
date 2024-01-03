<?php
require 'function.php';

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["queue"])) {
    $_SESSION["queue"] = new Queue(); // Inisialisasi objek Queue jika belum ada dalam session
}

global $queue;
// if(!isset($_SESSION["login"])){
//   header("Location: login.php");
//   exit;
// }

$id = $_GET["id_user"];

$synNama = "SELECT * FROM USER WHERE id_user = $id";
$nama = query($synNama);

$syn = "SELECT * FROM LAGU";
$lagus = query($syn);

$syntax = "SELECT * FROM PLAYLIST WHERE id_user = $id";
$playlists = query($syntax);

if (isset($_POST["btnPlaylist"])) {
    $txt = $_POST["searchPlaylist"];
    if ($txt == '') {
        $syntax = "SELECT * FROM PLAYLIST WHERE id_user = $id";
        $playlists = query($syntax);
    } else {
        $synx = "SELECT * FROM PLAYLIST WHERE id_user = $id AND nama_playlist LIKE '%$txt%' OR deskripsi LIKE '%$txt%'";
        $playlists = query($synx);
    }
}
if (isset($_POST["btnSong"])) {
    $text = $_POST["searchSong"];
    if ($text == '') {
        $syn = "SELECT * FROM LAGU";
        $lagus = query($syn);
    } else {
        $syn = "SELECT * FROM LAGU WHERE judul_lagu LIKE '%$text%' OR penyanyi LIKE '%$text'";
        $lagus = query($syn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>PETIFY</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/music.css" />
    <!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap");

        * {
            outline: none;
            box-sizing: border-box;
        }

        /* body {
font-family: "Open Sans", sans-serif;
margin: 0;
height: 100vh;
display: flex;
align-items: center;
justify-content: center;
flex-direction: column;
} */
        /* .music-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 20px 20px 0 rgba(0, 0, 0, 0.6);
            display: flex;
            padding: 20px 30px;
            position: relative;
            margin: 100px 0;
            z-index: 10;
        } */
        /*rgba(0, 0, 0, 0.6)  #1a75ff;*/

        .music-container {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 20px 20px 0 rgba(0, 0, 0, 0.6);
        display: flex;
        padding: 20px 30px;
        position: relative;
        margin: 100px auto; /* Mengubah margin agar terpusat */
        max-width: 400px; /* Menambahkan batas lebar maksimum */
        width: 100%; /* Menyesuaikan lebar dengan parent container */
        z-index: 10;
        /* margin: 70px auto; */
        }


        .img-container {
            position: relative;
            width: 110px;
        }

        .img-container::after {
            content: "";
            background-color:whitesmoke;
            border-radius: 50%;
            position: absolute;
            bottom: 85%;
            left: 50%;
            width: 23px;
            height: 23px;
            transform: translate(-50%, 50%);
            box-shadow: 0 0 0px 10px #000;
        }

        .img-container img {
            border-radius: 50%;
            object-fit: cover;
            height: 110px;
            width: inherit;
            position: absolute;
            bottom: 0;
            left: 0;
            animation: rotate 3s linear infinite;
            animation-play-state: paused;
        }

        .music-container.play .img-container img {
            animation-play-state: running;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .navigation {
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .action-btn {
            background-color: #fff;
            border: 0;
            color: #000000;
            font-size: 20px;
            cursor: pointer;
            padding: 10px;
            margin: 0 33px;
        }

        .action-btn.action-btn-big {
            color: #000000;
            font-size: 30px;
        }

        .music-info {
            background-color: rgba(255, 255, 255, 0.5);
            width: calc(100% - 40px);
            padding: 10px 10px 10px 150px;
            border-radius: 15px 15px 0px 0px;
            position: absolute;
            top: 0;
            left: 20px;
            opacity: 0;
            transform: translateY(0%);
            transition: transform 0.3s ease-in, opacity 0.3s ease-in;
            z-index: 0;
        }

        .music-container.play .music-info {
            opacity: 1;
            transform: translateY(-100%);
        }

        .music-info h4 {
            margin: 0;
        }

        .progress-container {
            background-color: #fff;
            border: 5px;
            cursor: pointer;
            margin: 10px 0;
            height: 4px;
            width: 100%;
        }

        .progress {
            background-color: #fe8daa;
            border-radius: 5px;
            height: 100%;
            width: 0%;
            transform: width 0.1s linear;
        }
        .search-input {
        height: 33px;
        margin-left: 10px;
        }

        .search-button {
            
        margin-left: 20px;
        }

        #player {
            display: none;
        }
        .navbar {
            background: -webkit-linear-gradient(right,#003366,#004080,#0059b3
      , #0073e6);
        }
        footer {
            background: -webkit-linear-gradient(right,#003366,#004080,#0059b3
      , #0073e6);
        }
        /* form {
            background-color: -webkit-linear-gradient(right,#003366,#004080,#0059b3
      , #0073e6);
        } */
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>



    <!-- ***** Header Area Start ***** -->
    <header>
        <div style="position: fixed; z-index: 100; width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-dark p-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Selamat Datang, <?php echo $nama[0]['username_user'] ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ms-auto">
                            <li>
                                <h1 style="color: dark;">&nbsp;</h1>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2 active" aria-current="page" href="#laguMain">Player</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="#playlist">Playlist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="#lagu">Lagu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="formLagu.php?id_user=<?php echo $id; ?>">Playlist Management</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="user-AddLagu.php?id_user=<?php echo $id; ?>">Add Song</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="adminLogin.php">Admin Center</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-2" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <br><br><br id="laguMain"><br><br><br>
    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <!-- 2. Add Play/Pause button -->
    <!-- <button onclick="togglePlayPause()">Play/Pause Video</button> -->

    <!-- Setting Tampilan -->
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <h1>Music Player</h1>
                <div class="music-container" id="music-container">
                    <div class="music-info">
                        <h4 class="title" id="title"></h4>
                        <div class="progress-container" id="progress-container">
                            <div class="progress" id="progress"></div>
                        </div>
                    </div>
                    <audio src="./music/happyrock.mp3" id="audio"></audio>
                    <div class="img-container">
                        <img src="assets/images/vinyl.jpg" alt="music-cover" id="cover" />
                    </div>
                    <div class="navigation">
                        <button id="play" class="action-btn action-btn-big" onclick="togglePlayPause()">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </button>
                        <button id="next" class="action-btn">
                            <i class="fa fa-forward" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <!-- Penutup Tampilan -->
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <br><br id="playlist"><br><br><br>

    <!-- Playlist -->
    <form action="" method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAFTAR PLAYLIST</h1>
                </div>
                <div class="col-md-2">
                    <label for=""><span style="font-weight: bold; font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cari Playlist : </span></label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="searchPlaylist" class="search-input" style="height: 35px;">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" name="btnPlaylist" type="submit" style="height: 35px;">Search</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Table Playlist -->
    <div class="container">
        <table class="table table-bordered" style="word-wrap: break-word;">
            <tr class="table-dark">
                <td>No</td>
                <td>Playlist name</td>
                <td>Description</td>
                <td>Daftar Lagu</td>
                <td>Queue</td>
                <td>Delete</td>
            </tr>
            <?php $j = 1; ?>
            <?php foreach ($playlists as $playlist) : ?>
                <tr>
                    <td>
                        <?php echo $j; ?>
                    </td>
                    <td>
                        <?php echo $playlist["nama_playlist"]; ?>
                    </td>
                    <td>
                        <?php echo $playlist["deskripsi"]; ?>
                    </td>
                    <td>
                        <table>
                            <?php
                            $idUser = $_GET["id_user"];
                            $idPlaylist = $playlist["id_playlist"];

                            $synn = "SELECT * FROM TRACK_LAGU WHERE id_user = $idUser AND id_playlist = $idPlaylist";
                            $results = query($synn);
                            ?>
                            <?php $k = 1; ?>
                            <?php foreach ($results as $result) : ?>
                                <tr>
                                    <td><?php echo "$k." ?></td>
                                    <td>
                                        <?php

                                        $find = $result["id_lagu"];
                                        $syntaxx = "SELECT * FROM LAGU WHERE id_lagu = $find";
                                        $hasilAkhir = query($syntaxx);
                                        ?>
                                        <?php echo $hasilAkhir[0]["judul_lagu"]; ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="deleteSongFromPlaylist.php?id_track=<?php echo $result["id_track"];?>&id_user=<?php echo $id; ?>">Delete Song</a>
                                    </td>
                                </tr>
                                <?php $k++; ?>
                            <?php endforeach; ?>
                        </table>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="playlistToQueue.php?id_user=<?php echo $id; ?>&id_playlist=<?php echo $playlist["id_playlist"] ?>">Add to Queue</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="deletePlaylist.php?id_user=<?php echo $id; ?>&id_playlist=<?php echo $playlist["id_playlist"]; ?>">Delete Playlist</a>
                    </td>
                </tr>
                <?php $j++; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <br><br id="lagu"><br><br><br><br><br>
    <!-- Lagu -->
    <form action="" method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAFTAR LAGU</h1>
                </div>
                <div class="col-md-2">
                    <label for=""><span style="font-weight: bold; font-size:24px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cari Lagu     : </span></label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="searchPlaylist" class="search-input" style="height: 35px;">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" name="btnPlaylist" type="submit" style="height: 35px;">Search</button>
                </div>
            </div>
        </div>
    </form>

    <!-- List lagu -->
    <div class="container">
        <table class="table table-bordered">
            <tr class="table-dark">
                <td>No</td>
                <td>Judul Lagu</td>
                <td>Penyanyi</td>
                <td>Add to Queue</td>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($lagus as $lagu) : ?>
                <tr>
                    <td>
                        <?php echo $i ?>
                    </td>
                    <td>
                        <?php echo $lagu["judul_lagu"]; ?>
                    </td>
                    <td>
                        <?php echo $lagu["penyanyi"]; ?>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="addToQueue.php?id_user=<?php echo $id; ?>&id_lagu=<?php echo $lagu["id_lagu"]; ?>">Add to Queue</a>
                    </td>
                    <?php $i++; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Created by Javier, Hansel, Nelson, Robert</p>
      </div>
    </div>
  </footer>
    <script src="script.js"></script>
    <script>
        // var myQueue = new Queue();
        // myQueue.enqueue('Dpo8hQ-0JYw');
        var player;
        var isPlaying = false;
        var videoIds = ['Dpo8hQ-0JYw', 'RZQyqT0k_6E', '77vnYdkzhuo', 'FViAQQlZpjs']; // Ganti dengan ID video YouTube yang sesuai

        // 3. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 4. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        // function onYouTubeIframeAPIReady() {
        //   player = new YT.Player('player', {
        //     height: '390',
        //     width: '640',
        //     videoId: 'RZQyqT0k_6E',
        //     playerVars: {
        //       'playsinline': 1
        //     },
        //     events: {
        //       'onReady': onPlayerReady,
        //       'onStateChange': onPlayerStateChange
        //     }
        //   });
        // }
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '390',
                width: '640',
                videoId: 'Fpn1imb9qZg', // Mulai dengan video pertama dalam array
                playerVars: {
                    'playsinline': 1
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // 5. The API will call this function when the video player is ready.
        function onPlayerReady(event) {
            // Uncomment the next line if you want the video to start playing automatically
            // event.target.playVideo();
        }

        // 6. The API calls this function when the player's state changes.
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING) {
                isPlaying = true;
            } else {
                isPlaying = false;
            }
            if (event.data == YT.PlayerState.ENDED) {
                nextSong();
            }
        }

        // 7. Function to play/pause the video
        function togglePlayPause() {
            if (player) {
                if (isPlaying) {
                    player.pauseVideo();
                } else {
                    player.playVideo();
                }
            }
        }

        // Script Tampilan
        const musicContainer = document.getElementById("music-container");
        const playBtn = document.getElementById("play");
        const prevBtn = document.getElementById("prev");
        const nextBtn = document.getElementById("next");
        const audio = document.getElementById("audio");
        const progress = document.getElementById("progress");
        const progressContainer = document.getElementById("progress-container");
        const title = document.getElementById("title");
        const cover = document.getElementById("cover");
        // Songs Titles
        const songs = ["Audio is Playing "];
        // KeepTrack of song
        let songIndex = 0;
        // Initially load song details into DOM
        loadSong(songs[songIndex]);
        // Update song details
        function loadSong(song) {
            title.innerText = song;
            audio.src = `./music/${song}.mp3`;
            cover.src = `assets/images/vinyl.jpg`;
        }
        // Play Song
        function playSong() {
            musicContainer.classList.add("play");
            playBtn.querySelector("i.fa").classList.remove("fa-play");
            playBtn.querySelector("i.fa").classList.add("fa-pause");
            audio.play();
        }
        // Pause Song
        function pauseSong() {
            musicContainer.classList.remove("play");
            playBtn.querySelector("i.fa").classList.add("fa-play");
            playBtn.querySelector("i.fa").classList.remove("fa-pause");
            audio.pause();
        }
        // Previous Song
        // function prevSong() {
        // songIndex--;
        // if (songIndex < 0) {
        // songIndex = songs.length - 1;
        // }
        // loadSong(songs[songIndex]);
        // playSong();
        // }
        // Next Song
        // function nextSong() {
        // songIndex++;
        // if (songIndex > songs.length - 1) {
        // songIndex = 0;
        // }
        // loadSong(songs[songIndex]);
        // playSong();
        // }
        function nextSong() {
            let $url = "dequeue.php";
            $.ajax({
                type: "GET",
                data: {

                },
                url: $url,
                success: function(response) {
                    let id = response;
                    player.loadVideoById(id);
                }
            })
        }

        // function nextSong() {
        //     var currentLink = myQueue.dequeue();
        //     player.loadVideoById(currentLink);
        // }
        // Update Progress bar
        function updateProgress(e) {
            const {
                duration,
                currentTime
            } = e.srcElement;
            const progressPerCent = (currentTime / duration) * 100;
            progress.style.width = `${progressPerCent}%`;
        }
        // Set Progress
        function setProgress(e) {
            const width = this.clientWidth;
            const clickX = e.offsetX;
            const duration = audio.duration;
            audio.currentTime = (clickX / width) * duration;
        }
        // Event Listeners
        playBtn.addEventListener("click", () => {
            const isPlaying = musicContainer.classList.contains("play");
            if (isPlaying) {
                pauseSong();
            } else {
                playSong();
            }
        });
        // Change Song
        nextBtn.addEventListener("click", nextSong);
        // Time/Song Update
        audio.addEventListener("timeupdate", updateProgress);
        // Click On progress Bar
        progressContainer.addEventListener("click", setProgress);
        // Song End
        audio.addEventListener("ended", nextSong);
    </script>
</body>

</html>