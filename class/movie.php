<?php 


    class Movie {
        public  $te_name ;
        public $te_size ;
        public $te_file_id ;
        public $type ;
        public $prompt  ;
        public $saison ;
        public $episode ;
        private $conn ;
        public $prompt2 ;
        public $save  ;
        public $name ;
        public $name0 ;

        //public  "save.json" = "save.json" ;

        public function __construct($name , $size , $file_id , $pdo){
            $this->te_name = $name ;
            $this->te_size = $size ;
            $this->te_file_id = $file_id ;
            $this->conn = $pdo  ;
            $this->save = 'save0.json';
            $this->setPrompt() ;
            $this->name0 = $this-> getMovieName($this->prompt2 , true) ;
            $this->name = $this-> getMovieName($this->prompt ) ;
            $this ->setName() ;
           

        }
        

        public function setName (){
            if($this->isSerie(trim($this->name0))){
                $this->type = 'serie';
                $gse = $this->getSaisonAndEp (trim($this->name0)) ;
                $this->saison = $gse['season'] ;
                $this->episode = $gse['episode'] ;
            } else {
                $this->type = 'film' ;
                $this->saison = 'null' ;
                $this->episode = 'null' ;
               
            }
        }
        public function setPrompt() {
            $this->prompt = "renvoi seulement le nom du film ou de la serie sans la saison ou l'episode  :" . $this->te_name . " , juste le nom";
            $this->prompt2 = "detect et retourn le nom de la serie ou du film.retourne juste le nom si tu detecte la presence de saison et ou  d'episode tu renvoi le nom + saison + episode. 
   " . $this->te_name . "";
            
          }

        public function getTrailer(){
            
        } 
        public function echoo() {
            $tmdb = $this->tmdb($this->name);
        
            if ($tmdb) {
                return $tmdb;
            } else {
                // Gérer le cas où TMDb échoue
                return $this->ytb_info($this->name, false) ?? [];
            }
        }
        
       
    public function saveMsg($user, $string ,$prompt) {
    // Charger les anciennes données si elles existent
    //  global "save.json" ;
    $model = str_replace(array("\r\n", "\n", "\r"), '', $string) ;

    $existingData = file_exists((!$prompt) ?"save.json" : "save0.json") ? json_decode(file_get_contents((!$prompt) ?"save.json" : "save0.json"), true) : [];
    
    // Ajouter les nouvelles données
    $existingData[] = ["role" => "user", "parts" => [["text" => $user]]];
    $existingData[] = ["role" => "model", "parts" => [["text" => $model]]];
    
    // Sauvegarder le tout dans save.json
    file_put_contents((!$prompt) ?"save.json" : "save0.json", json_encode($existingData, JSON_PRETTY_PRINT));
}

        public function getMovieName($message , $prompt=null){

           
            //global "save.json" ;
   
            $api_key = "AIzaSyDz4GJFqOuFhtePOC3l1egNjdusLQrEYGc";
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=$api_key";
            
            // Charger les anciennes données
            $existingData = file_exists("save.json") ? json_decode(file_get_contents("save.json"), true) : [];
        
            // Préparer les données à envoyer à l'API
        
        $parts = [
            [
                "text" => $message
            ]
        ];
        global $imageData ;
        // Ajouter "inline_data" uniquement si $imageData existe
        if ($imageData) {
            $inlineData = [
                'mime_type' => 'image/jpeg',
                'data' => $imageData
            ];
        
            $parts[] = [
                "inline_data" => $inlineData
            ];
        }
        
        // Créer la nouvelle structure avec le rôle "user" et les parts
        $newUserContent = [
            "role" => "user",
            "parts" => $parts
        ];
        
        
        $data = array(
            "contents" => array_merge(
                $existingData,[$newUserContent]
        )
            );
        
        
        
        
            
            $ch = curl_init();
            $headers = array("Content-Type: application/json");
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            
            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
             $this->saveMsg($message, $result['candidates'][0]['content']['parts'][0]['text'] , $prompt) ;
                return $result['candidates'][0]['content']['parts'][0]['text'];
            } else {
                return "Erreur: Aucun texte retourné par l'API $result.";
            }
               }

               public function ytb_info($name, bool $video) {
                // Encode correctement le nom pour l'URL
                $name = urlencode($name);
                $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q={$name}%20bande%20annonce%20vf&key=AIzaSyB_EBrUZHKmaIh845Sn2uc6LNSuG4czraE&maxResults=1";
                
                $data = json_decode(file_get_contents($url), true);
            
                if ($data && isset($data['items'][0])) {
                    if ($video) {
                        return ["video_id" => $data['items'][0]['id']['videoId']];
                    } else {
                        return [
                            "video_id" => $data['items'][0]['id']['videoId'] ?? 'non trouver',
                            "name" => $this->name,
                            "image" => $data['items'][0]['snippet']['thumbnails']['high']['url'],
                            "description" => $data['items'][0]['snippet']['description']
                        ];
                    }
                } else {
                    return null; // Gérer le cas où aucune donnée n'est retournée
                }
            }
            
        

            public function tmdb($movieName) {
                $apiKey = 'ee899411743f08097e0a2e4b06949a47';
                
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
                    // Choisir le premier résultat
                    $movie = $data['results'][0];
                    
                    // Récupérer les noms des genres du film
                    $movieGenres = [];
                    foreach ($movie['genre_ids'] as $genreId) {
                        if (isset($genres[$genreId])) {
                            $movieGenres[] = $genres[$genreId];
                        }
                    }
                    
                    // Récupérer les informations de la bande-annonce
                    $ytb = $this->ytb_info($this->name, true);
                    
                    // Retourner les informations du film, y compris les genres
                    return [
                        'name' => $movie['name'] ?? $movie['title'] ?? 'inconnu' ,
                        'description' => $movie['overview'] ?? 'Pas de description',
                        'image' => "https://image.tmdb.org/t/p/w500" . ($movie['poster_path'] ?? ''),
                        'genres' => implode(', ', $movieGenres),
                        'video_id' => $ytb['video_id'] ?? null,
                    ];
                } else {
                    return null; // Aucun résultat trouvé
                }
            }
            

        public function getSaisonAndEp($fileName){
            // Remove unwanted words from the filename
            $unwantedWords = array('serie', 'film', 'bluray', 'other');
            $fileName = preg_replace('/\b('.implode('|', $unwantedWords).')\b/i', '', $fileName);
        
        
        
            $seriePatterns = array(
                '/saison\s+\d+\s+episode\s+\d+/i', // Saison X Episode Y
                '/saison\s+\d+\s+épisode\s+\d+/i', // Saison X Épisode Y (avec accent)
                '/s\d{1,2}(?:e\d{1,2})?/i', // S01, S1, etc. (avec ou sans épisode)
                '/e\d{1,2}/i', // E01, E2, etc.
                '/ep\d+/i', // Ep1, Ep2, etc.
                '/ép\d+/i', // Ép1, Ép2, etc. (avec accent)
                '/episode\s+\d+/i', // Episode 1, Episode 2, etc.
                '/épisode\s+\d+/i', // Épisode 1, Épisode 2, etc. (avec accent)
                '/season\s+\d+\s+episode\s+\d+/i', // Season X Episode Y (anglais)
                '/season\s+\d+\s+ep\s+\d+/i', // Season X Ep Y (anglais)
                '/se\d{1,2}(?:e\d{1,2})?/i', // SE01, SE1, etc. (anglais avec ou sans épisode)
            );
            $patterns = array_merge([
                '/saison\s?([0-9]{1,2})[^\d]*(épisode|ep|e)\s?([0-9]{1,2})/i',  
                '/season\s?([0-9]{1,2})[^\d]*(episode|ep|e)\s?([0-9]{1,2})/i',  
                '/s([0-9]{1,2})e([0-9]{1,2})/i',                               
                '/\b([0-9]{1,2})x([0-9]{1,2})\b/i',                             
                '/S([0-9]{1,2})\s+E([0-9]{1,2})/i'  // S03 E03, etc.
            ], $seriePatterns);
            $result = ['season' => null, 'episode' => null];
        
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $fileName, $matches)) {
                    if (isset($matches[1]) && isset($matches[3])) {
                        $season = (int)$matches[1];
                        $episode = (int)$matches[3];
                    } elseif (isset($matches[1]) && isset($matches[2])) {
                        $season = (int)$matches[1];
                        $episode = (int)$matches[2];
                    } else {
                        continue; // skip if no season or episode found
                    }
        
                    if ($season >= 0 && $season <= 30 && $episode >= 0 && $episode <= 100) {
                        $result['season'] = $season;
                        $result['episode'] = $episode;
                        break;
                    }
                }
            }
        
            return $result;
        }
        public function isSerie($title) {
            $seriePatterns = array(
              '/saison\s+\d+\s+episode\s+\d+/i', // Saison X Episode Y
              '/saison\s+\d+\s+épisode\s+\d+/i', // Saison X Épisode Y (avec accent)
              '/s\d{1,2}(?:e\d{1,2})?/i', // S01, S1, etc. (avec ou sans épisode)
              '/e\d{1,2}/i', // E01, E2, etc.
              '/ep\d+/i', // Ep1, Ep2, etc.
              '/ép\d+/i', // Ép1, Ép2, etc. (avec accent)
              '/episode\s+\d+/i', // Episode 1, Episode 2, etc.
              '/épisode\s+\d+/i', // Épisode 1, Épisode 2, etc. (avec accent)
              '/season\s+\d+\s+episode\s+\d+/i', // Season X Episode Y (anglais)
              '/season\s+\d+\s+ep\s+\d+/i', // Season X Ep Y (anglais)
              '/se\d{1,2}(?:e\d{1,2})?/i', // SE01, SE1, etc. (anglais avec ou sans épisode)
            );
          
            $filmPatterns = array(
              '/hdlight/i', // HDLight
              '/1080p/i', // 1080p
              '/multi/i', // MULTI
              '/bluray/i', // BluRay
              '/dvdrip/i', // DVDrip
              '/webrip/i', // WebRip
            );
          
            foreach ($seriePatterns as $pattern) {
              if (preg_match($pattern, $title)) {
                foreach ($filmPatterns as $filmPattern) {
                  if (!preg_match($filmPattern, $title)) {
                    return true;
                  }
                }
              }
            }
          
            return false;
          }

        public function insert() {
            $movie = $this->echoo();
        
            // Préparer la requête SQL correctement avec les placeholders pour les paramètres
            $req = $this->conn->prepare("INSERT INTO movie (name, file_id, image, trailer, type, saison, episode, description) VALUES (:name, :file_id, :image, :trailer, :type, :saison, :episode, :description)");
        
            // Liaison des paramètres avec les valeurs
            $req->bindParam(':name', $movie['name']);
            $req->bindParam(':image', $movie['image']);
            $req->bindParam(':file_id', $this->te_file_id);
            $req->bindParam(':trailer', $movie['video_id']);
            $req->bindParam(':type', $this->type);
            $req->bindParam(':saison', $this->saison);
            $req->bindParam(':episode', $this->episode);
            $req->bindParam(':description', $movie['description']);
        
            try {
                // Exécuter la requête
                $req->execute();
                return true; // La requête s'est exécutée avec succès
            } catch (PDOException $e) {
                // Enregistre l'erreur ou affiche-la
              return   $e->getMessage();
                ;
            }
            
        }
        
        public static function startBtn($user_name, $chat_id , $token){
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'DÉMARRER', 'url' => 'https://t.me/TgfilescrapBot/noflix']
                    ]
                ]
            ];
            
            $data = [
                'chat_id' => $chat_id,
                'text' => "salut $user_name Bienvenu sur Noflix clique pour lancer la web app :",
                'reply_markup' => json_encode($keyboard)
            ];
            
            file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
            
            
        }

        public static function  getMovie($limite , $offset ,PDO $conn){
            $req = $conn->prepare("SELECT DISTINCT * FROM movie ORDER BY id DESC LIMIT :limite OFFSET :offset");
            $req->bindParam(':limite',$limite, PDO::PARAM_INT);
            $req->bindParam(':offset', $offset, PDO::PARAM_INT);
            $req->execute();
            
            // Récupération des résultats
            $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
            
            // Affichage des résultats
     return $resultats ;
        }
    }

?>