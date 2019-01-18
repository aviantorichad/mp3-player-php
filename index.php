<!DOCTYPE>
<html>
    <head>
        <title>Spotify Abal-abal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {background: #222;color: #fff;font-family: arial;}
            #sedang-main {padding:10px;font-size: 24px;font-weight: bold;color: gold;}
            #audio-player {width:100%;margin: 20px auto;}
            #playlist {list-style: none;margin: 0;padding: 0;}
            #playlist li {padding: 0px;border-bottom: 1px solid #999;}
            #playlist li a {padding: 10px; text-decoration: none;color: #999;display:block;}
	    #playlist li a:hover {background: #555;color: #fff;}
	    #cariLagu {width: 100%;
    background: #222;
    border: 0;
    border-bottom: 1px solid #555;
    padding: 10px;
    color: #fff;}
        </style>
    </head>
    <body>
    <marquee behavior="alternate" id="sedang-main">Judul Lagu</marquee>

    <audio controls id="audio-player">
        <source id="audio-source">
            Browser anda tidak mendukung, silakan gunakan browser versi jaman now
    </audio>
	<input id="cariLagu" type="text" placeholder="Search..">
        <?php
            $dir = "playlists/";
            if(is_dir($dir)){
                if($buka = opendir($dir)) {
                    echo '<ul id="playlist">';
                    while(($file = readdir($buka)) !== false) {
                        if(strpos($file, '.mp3')) {
                            echo '<li><a href="javascript:void(0)">'.$file.'</a></li>';
                        }
                    }
                    echo '</ul>';
                    closedir($buka);
                }
            }
        ?>

        <script src="jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                var folder = "playlists/";
                var urutan = 0;
                var file, mainkan = "";

                $('#playlist a').on('click', function() {
                    urutan = $(this).parent().prevAll().length;
                    playAudio(urutan);
                });

                $('#audio-player').on('ended', function(){
                    urutan++;
                    if(urutan == $('#playlist a').length){
                        urutan = 0;
                    }
                    playAudio(urutan);
                });

                function playAudio(urutan) {
                    file = $('#playlist a:eq(' + urutan + ')').text();
                    mainkan = folder + file;
                    $('#sedang-main').html(file);
                    $('#audio-source').prop('src', mainkan);
                    $('#audio-player').trigger('load');
                    $('#audio-player').trigger('play');
		}

$("#cariLagu").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#playlist li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
            });
        </script>
    </body>
</html>
