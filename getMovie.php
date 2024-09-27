<?php 
require_once ('./class/movie.php') ;

require_once ('./conn/database.php') ;
function formatGetMovie($limite , $offset, $conn){
    $movies = movie::getMovie($limite ,$offset, $conn ) ;

    foreach($movies as $movie){
        $name = $movie['name'] ;
        $id = $movie['id'] ;
        $image = $movie['image'] ;
        $trailer = $movie['trailer'] ;


        echo "
        
             <div class='movie' onclick='playMovie($id)'>
                <img id='$id-imgUrl' alt='Stranger Things poster, dark atmosphere with kids on bicycles' src='$image' width='150' height='225'>
                    <div id='$id-name' class='movie-title'>$name</div>
                 <div style='display: none' class='hidden'>
                        <div id='$id-trailer' class='movie-trailer'>$trailer</div>
                </div>

            </div>
        " ;

    }
} ;


formatGetMovie($_REQUEST['limit'] , $_REQUEST['offset'] , $pdo) ;

?>


