<pre>
    <?php




function movie_trailer_ytb_id($name){
    
    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$name%20%bande%20%annonce%20%vf&key=AIzaSyB_EBrUZHKmaIh845Sn2uc6LNSuG4czraE&maxResults=1" ;
    $data = json_decode(file_get_contents($url) , true) ;

    return [
        "video_id" => $data['items'][0]['id']['videoId'] ,
        "image"    => $data['items'][0]['snippet']['thumbnails']['high']['url'] ,
        "description"    =>$data['items'][0]['snippet']['description']
    ] ;
   // print_r() ;
}

var_dump(movie_trailer_ytb_id('supracell'));
?>
</pre>

