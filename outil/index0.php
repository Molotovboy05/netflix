<?php 
 $info = file_get_contents("php://input");

 $data = json_decode($info, true);


$token = '7324604698:AAHdWswmNPwwbv1KIKZo_-xfSseLYRLLKrg';
$chat_id =$data['message']['chat']['id']; // Remplace par l'ID du chat ou de l'utilisateur
$user_name =$data['message']['chat']['first_name'] ??  $data['message']['chat']['username'] ;
$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => 'DÉMARRER', 'url' => 'https://t.me/TgfilescrapBot/noflix']
        ]
    ]
];

$data = [
    'chat_id' => $chat_id,
    'text' => 'Cliquez sur le bouton pour lancer la web app :',
    'reply_markup' => json_encode($keyboard)
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));





?>