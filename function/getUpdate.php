<?php

function getVideoFileInfoFromWebhook($update) {


    // Décoder le JSON en tableau associatif
    $data = json_decode($update, true);

    // Vérifier si le message contient une vidéo
    if (isset($data['message']['video'])&&  isset($data['message']['video']['file_name'] )) {
        // Récupérer les détails de la vidéo
        $file_name = $data['message']['video']['file_name'];
        $file_size = $data['message']['video']['file_size'];
        $file_id = $data['message']['video']['file_id'];

        // Retourner les informations sous forme de tableau
        return [
            'file_name' => $file_name,
            'file_size' => $file_size,
            'file_id' => $file_id
        ];
    } 
    elseif (isset($data['message']['document']) && isset( $data['message']['document']['file_name']) ) {
        # code...
                // Récupérer les détails de la vidéo
                $file_name = $data['message']['document']['file_name'];
                $file_size = $data['message']['document']['file_size'];
                $file_id = $data['message']['document']['file_id'];
        
                // Retourner les informations sous forme de tableau
                return [
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_id' => $file_id
                ];
    } elseif ( isset($data['message']['caption'])) {
        # code...
        $file_size = $data['message']['document']['file_size'] ??  $data['message']['video']['file_size'];;
        $file_id = $data['message']['document']['file_id'] ?? $data['message']['video']['file_id'];
        $file_name  =$data['message']['caption'] ; 

        return [
            'file_name' => $file_name,
            'file_size' => $file_size,
            'file_id' => $file_id
        ];
    }
    
    else {
        // Si aucune vidéo n'est trouvée, retourner null ou un message d'erreur
        return 'aucun nom trouver';
    }
}



?>