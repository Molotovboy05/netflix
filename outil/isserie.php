<?php

function isSerie($title) {
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

// Exemple d'utilisation
$title = '[ Torrent911.pm ] World.Invasion.2011.MULTi.HDLight.1080p.mkv';
if (isSerie($title)) {
  echo "Le titre \"$title\" est probablement un épisode de série TV.";
} else {
  echo "Le titre \"$title\" n'est probablement pas un épisode de série TV.";
}

?>