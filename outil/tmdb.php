<?php

function cleanMovieTitle($filename) {
    // Enlève l'extension de fichier
    $filename = preg_replace('/\.(mkv|mp4|avi|mov|wmv)$/i', '', $filename);
    
    // Remplace les underscores et tirets par des espaces
    $filename = preg_replace('/[_-]/', ' ', $filename);
    
    // Enlève tout ce qui est entre parenthèses (années, infos supplémentaires)
    $filename = preg_replace('/\s*\(.*?\)\s*/', ' ', $filename);
    
    // Supprime les espaces supplémentaires
    $filename = trim(preg_replace('/\s+/', ' ', $filename));

    return $filename;
}

function getMovieInfo($movieName) {
    $apiKey = '0030ef6e2e7c4cf76791b2904e6bc3d8';
    
    // Récupérer la liste des genres depuis l'API TMDb
    $genreUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key=$apiKey&language=fr-FR";
    $genreResponse = file_get_contents($genreUrl);
    $genreData = json_decode($genreResponse, true);

    // Créer un tableau associatif pour correspondre genre_id => nom du genre
    $genres = [];
    foreach ($genreData['genres'] as $genre) {
        $genres[$genre['id']] = $genre['name'];
    }

    // Rechercher le film par nom
    $url = "https://api.themoviedb.org/3/search/multi?api_key=$apiKey&query=" . urlencode($movieName) . "&language=fr-FR";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (!empty($data['results'])) {
        $movie = $data['results'][0];

        // Récupérer les noms des genres du film
        $movieGenres = [];
        foreach ($movie['genre_ids'] as $genreId) {
            if (isset($genres[$genreId])) {
                $movieGenres[] = $genres[$genreId];
            }
        }

        // Retourner les informations du film, y compris les genres
        return [
            'name' => $movie['name'],
            //'original_title' => $movie['original_title'],
            'synopsis' => $movie['overview'],
            'poster_path' => "https://image.tmdb.org/t/p/w500" . $movie['poster_path'],
            'genres' => implode(', ', $movieGenres) // Conversion de la liste des genres en chaîne de caractères
        ];
    } else {
        return null;
    }
}


// Exemple d'utilisation avec un nom de fichier
$filename = 'SupraCell';
$cleanTitle = cleanMovieTitle($filename);
var_dump($cleanTitle) ;
echo '<br>' ;
echo '<br>' ;
echo '<br>' ;
$movieInfo = getMovieInfo($filename);

if ($movieInfo) {
    echo "Titre : " . $movieInfo['name'] . "<br>";
  //  echo "Titre original : " . $movieInfo['original_title'] . "<br>";
    echo "Synopsis : " . $movieInfo['synopsis'] . "<br>";
    echo "Genre : ".$movieInfo['genres'] ;
    echo "Lien vers l'image : <a href='" . $movieInfo['poster_path'] . "'>Voir l'image</a><br>";
    echo "<img src='" . $movieInfo['poster_path'] . "' alt='" . $movieInfo['title'] . "' />";
} else {
    echo "Aucun film trouvé.";
}


?>


