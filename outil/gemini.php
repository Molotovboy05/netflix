<?php
$savefile = "save.json" ;
function saveMsg($user, $model ) {
    // Charger les anciennes données si elles existent
      global $savefile ;

    $existingData = file_exists($savefile) ? json_decode(file_get_contents($savefile), true) : [];
    
    // Ajouter les nouvelles données
    $existingData[] = ["role" => "user", "parts" => [["text" => $user]]];
    $existingData[] = ["role" => "model", "parts" => [["text" => $model]]];
    
    // Sauvegarder le tout dans save.json
    file_put_contents($savefile, json_encode($existingData, JSON_PRETTY_PRINT));
}

function gemini($message) {
    global $savefile ;
   
       $api_key = "AIzaSyDz4GJFqOuFhtePOC3l1egNjdusLQrEYGc";
       $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=$api_key";
       
       // Charger les anciennes données
       $existingData = file_exists($savefile) ? json_decode(file_get_contents($savefile), true) : [];
   
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
        saveMsg($message, $result['candidates'][0]['content']['parts'][0]['text']) ;
           return $result['candidates'][0]['content']['parts'][0]['text'];
       } else {
           return "Erreur: Aucun texte retourné par l'API $result.";
       }
   }

   
   $text =  'voici le resultat de recherche sur arrow dans tmdb 

   {
  "backdrop_path": "/wAFuDJfZJrnh6a1wf1Vt7PqYBvR.jpg",
     "id": 1412,
     "name": "Arrow",
     "original_name": "Arrow",
     "overview": "Les nouvelles aventures de Green Arrow/Oliver Queen, combattant ultra efficace issu de l\'univers de DC Comics et surtout archer au talent fou, qui appartient notamment à la Justice League. Disparu en mer avec son père et sa petite amie, il est retrouvé vivant 5 ans plus tard sur une île près des côtes Chinoises. Mais il a changé : il est fort, courageux et déterminé à débarrasser Starling City de ses malfrats...",
     "poster_path": "/4DVLTc7oVCzHOSmZzlDHefCKyqq.jpg",
     "media_type": "tv",
     "adult": false,
     "original_language": "en",
     "genre_ids": [
         80,
         18,
         10759
     ],
     "popularity": 231.905,
     "first_air_date": "2012-10-10",
     "vote_average": 6.822,
     "vote_count": 5891,
     "origin_country": [
         "US"
     ]
 },
 {
     "backdrop_path": "/lu34GoIkOhpvmgSvrFtDdXkIItI.jpg",
     "id": 96942,
     "name": "Back Arrow",
     "original_name": "バック・アロウ",
     "overview": "Ringerind est une terre entourée d\'un gigantesque mur. Ce dernier l\'enveloppe, la protège et contribue à son développement, au point d’en être déifié ; c’est l\'essence même de cette terre. Un jour, un mystérieux homme nommé Back Arrow apparaît dans un village reculé du nom d’Edger. Arrow est amnésique, mais il certifie venir de l’autre côté du mur. Il décide alors d’aller au-delà de ce dernier afin de recouvrer la mémoire, mais se retrouve peu à peu mêlé à un conflit dont il semble être le centre…",
     "poster_path": "/oixhCaRP25WH1PirMiIHSCn8lWN.jpg",
     "media_type": "tv",
     "adult": false,
     "original_language": "ja",
     "genre_ids": [
         16,
         10759,
         10765
     ],
     "popularity": 28.2,
     "first_air_date": "2021-01-09",
     "vote_average": 6.9,
     "vote_count": 16,
     "origin_country": [
         "JP"
     ]
 },
 {
     "backdrop_path": null,
     "id": 1139952,
     "title": "Arrow",
     "original_title": "Arrow",
     "overview": "Silent abstract video art piece using image processing by Chicago artist Cindy Neal.",
     "poster_path": "/lBV210R59zoQTZ6u897st0ywVo7.jpg",
     "media_type": "movie",
     "adult": false,
     "original_language": "en",
     "genre_ids": [
         16
     ],
     "popularity": 0.006,
     "release_date": "2012-01-01",
     "video": false,
     "vote_average": 0,
     "vote_count": 0
 },
 {
     "backdrop_path": null,
     "id": 616026,
     "title": "Arrow",
     "original_title": "Arrow",
     "overview": "Two stories are interconnected in this brief film: Mike, a teenager at Wisconsin Museum of Music, is surrounded by Native American collectibles. Elsewhere, Winfield, a young Native American dancer, bids farewell to his community.",
     "poster_path": null,
     "media_type": "movie",
     "adult": false,
     "original_language": "en",
     "genre_ids": [],
     "popularity": 0.303,
     "release_date": "2019-07-12",
     "video": false,
     "vote_average": 0,
     "vote_count": 0
 },


 
 lequel correspond a ce nom de fichier

"Arrow.S04E01 Shar.Club.mkv "
 '  ;

   var_dump(gemini( $text ))
?>