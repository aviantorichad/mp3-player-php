<!DOCTYPE html>
<html>
    <head>
        <title>Spotify Abal-abal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #cariLagu,body{background:#222;color:#fff}body{font-family:arial}#sedang-main{padding:10px;font-size:24px;font-weight:700;color:#222;background:#f1f3f4;margin-bottom:-24px}#audio-player{width:100%;margin:20px auto;border-radius:0;background:#f1f3f4}#playlist{list-style:none;margin:0 0 175px;padding:0}#playlist li{padding:0;border-bottom:1px solid #999}#playlist li a{padding:10px;text-decoration:none;color:#999;display:block}#playlist li a:hover{background:#555;color:#fff}#cariLagu{width:100%;border:0;border-bottom:1px solid #555;padding:10px}#container-player{position:fixed;width:100%;bottom:-20px;left:0;margin:0}
        </style>
    </head>
    <body>
        <div id="container-player">
            <input id="cariLagu" type="text" placeholder="Search..">
            <marquee behavior="alternate" id="sedang-main">Judul Lagu</marquee>
            <audio controls id="audio-player">
                <source id="audio-source">
                Browser anda tidak mendukung, silakan gunakan browser versi jaman now
            </audio>
        </div>
        
        <?php
        $dir = "playlists/";
        if (is_dir($dir)) {
            if ($buka = opendir($dir)) {
                echo '<ul id="playlist">';
                while (($file = readdir($buka)) !== false) {
                    if (strpos($file, '.mp3')) {
                        echo '<li><a href="javascript:void(0)">' . $file . '</a></li>';
                    }
                }
                echo '</ul>';
                closedir($buka);
            }
        }
        ?>

        <script src="jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){var t, l = "playlists/", a = 0, i = ""; function o(a){t = $("#playlist a:eq(" + a + ")").text(), i = l + t, $("#sedang-main").html(t), $("#audio-source").prop("src", i), $("#audio-player").trigger("load"), $("#audio-player").trigger("play")}$("#playlist a").on("click", function(){var t; a = $(this).parent().prevAll().length, t = a, $("#playlist li").css("background-color", "#222"), $("#playlist li").filter(function(l){return l === t}).css("background-color", "#037"), o(a)}), $("#audio-player").on("ended", function(){++a == $("#playlist a").length && (a = 0), o(a)}), $("#cariLagu").on("keyup", function(){var t = $(this).val().toLowerCase(); $("#playlist li").filter(function(){$(this).toggle($(this).text().toLowerCase().indexOf(t) > - 1)})})});
        </script>
    </body>
</html>
