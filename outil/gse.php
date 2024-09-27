<?php

function getSaisonAndEp($fileName){
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

var_dump(getSaisonAndEp("Le_gangster,le_flic_et_l'assassin_2019_VF_@filmsetseries653.mp4"));