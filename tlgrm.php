<?php
require_once './class/movie.php' ;
require_once ('./conn/database.php');
require_once ('function/getUpdate.php') ;
 $info = file_get_contents("php://input");
// Définir une fonction pour traiter les données du Webhook et extraire les infos du fichier vidéo

$token = '7324604698:AAHdWswmNPwwbv1KIKZo_-xfSseLYRLLKrg';
$data = json_decode($info , true) ;
$chat_id =$data['message']['chat']['id']; // Remplace par l'ID du chat ou de l'utilisateur
$user_name =$data['message']['chat']['first_name'] ??  $data['message']['chat']['username'] ;

$json = '
    {
    "update_id": 401894087,
    "message": {
        "message_id": 19,
        "from": {
            "id": 7097403742,
            "is_bot": false,
            "first_name": "aiko",
            "username": "aikowood",
            "language_code": "fr"
        },
        "chat": {
            "id": 7097403742,
            "first_name": "aiko",
            "username": "aikowood",
            "type": "private"
        },
        "date": 1726974041,
        "forward_origin": {
            "type": "channel",
            "chat": {
                "id": -1002084547063,
                "title": "365 JOURS VF 🇲🇫",
                "type": "channel"
            },
            "message_id": 67,
            "date": 1709856733
        },
        "forward_from_chat": {
            "id": -1002084547063,
            "title": "365 JOURS VF 🇲🇫",
            "type": "channel"
        },
        "forward_from_message_id": 67,
        "forward_date": 1709856733,
        "video": {
            "duration": 1557,
            "width": 1280,
            "height": 720,
            "mime_type": "video/mp4",
            "thumbnail": {
                "file_id": "AAMCBAADGQEAAxFm74ATOOW5kORoD9gGQGnmzMd--AACjA8AAnNaYFCiQ1qjh5vj1AEAB20AAzYE",
                "file_unique_id": "AQADjA8AAnNaYFBy",
                "file_size": 1198,
                "width": 320,
                "height": 180
            },
            "thumb": {
                "file_id": "AAMCBAADGQEAAxFm74ATOOW5kORoD9gGQGnmzMd--AACjA8AAnNaYFCiQ1qjh5vj1AEAB20AAzYE",
                "file_unique_id": "AQADjA8AAnNaYFBy",
                "file_size": 1198,
                "width": 320,
                "height": 180
            },
            "file_id": "BAACAgQAAxkBAAMRZu-AEzjluZDkaA_YBkBp5szHfvgAAowPAAJzWmBQokNao4eb49Q2BA",
            "file_unique_id": "AgADjA8AAnNaYFA",
            "file_size": 155837862
        },
        "caption": "Commissariat de tampy S03 E03: de père en fils"
    }
}

';


            if  (isset($data['message']['text'])){
                movie::startBtn($user_name, $chat_id, $token) ;
            } else {
                $videoInfo = getVideoFileInfoFromWebhook($info);
var_dump($videoInfo) ;


$movie = new Movie($videoInfo['file_name'] , $videoInfo['file_size'] , $videoInfo['file_id'] , $pdo);
var_dump($movie->insert());

var_dump($movie) ;
            } ;

// Exemple d'utilisation de la fonction

?>
