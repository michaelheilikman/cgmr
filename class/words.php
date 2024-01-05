<?php
function after ($thisObj, $inthat)
{
    if (!is_bool(strpos($inthat, $thisObj)))
    return substr($inthat, strpos($inthat,$thisObj)+strlen($thisObj));
};

function after_last ($thisObj, $inthat)
{
    if (!is_bool(strrevpos($inthat, $thisObj)))
    return substr($inthat, strrevpos($inthat, $thisObj)+strlen($thisObj));
};

function before ($thisObj, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $thisObj));
};

function before_last ($thisObj, $inthat)
{
    return substr($inthat, 0, strrevpos($inthat, $thisObj));
};

function between ($thisObj, $that, $inthat)
{
    return before ($that, after($thisObj, $inthat));
};

function between_last ($thisObj, $that, $inthat)
{
 return after_last($thisObj, before_last($that, $inthat));
};

// use strrevpos function in case your php version does not include it
function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};


function reduire($article, $nb_car, $delim='...') {
  $length = $nb_car;
  if($nb_car<strlen($article)){
  while (($article[$length] != " ") && ($length > 0)) {
   $length--;
  }
  if ($length == 0) return substr($article, 0, $nb_car) . $delim;
   else return substr($article, 0, $length) . $delim;
  }else return $article;
}

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'Ko', 'Mo', 'Go', 'To');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

function suppr_accents($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
 
    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
 
    // Remplacer les ligatures tel que : , Æ ...
    // Exemple "œ" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);

    $str = str_replace("'",'', $str);
    $str = str_replace(" ?",'', $str);
    $str = str_replace("?",'', $str);
    $str = str_replace(" !",'', $str);
    $str = str_replace("!",'', $str);
    $str = str_replace(".",'', $str);
    $str = str_replace(":",'', $str);
    $str = strtolower($str);
 
    return $str;
}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}
function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function removeEmojis( $string ) {
    $string = str_replace( "?", "{%}", $string );
    $string  = mb_convert_encoding( $string, "ISO-8859-1", "UTF-8" );
    $string  = mb_convert_encoding( $string, "UTF-8", "ISO-8859-1" );
    $string  = str_replace( array( "?", "? ", " ?" ), array(""), $string );
    $string  = str_replace( "{%}", "?", $string );
    return trim( $string );
}

function plural($word) {
    $lastChar = strtolower(substr($word, -1));
    switch ($lastChar) {
      case 's':
        return $word . 'es'; // féminin pluriel
      case 'x':
        return $word . 's'; // pluriel classique
      case 'l':
        return substr($word, 0, -1) . 'ux'; // cas particulier
      default:
        return $word . 's'; // pluriel classique
    }
  }
  
  // fonction pour transformer un mot au singulier
  function singular($word) {
    $lastThreeChar = strtolower(substr($word, -3));
    $lastChar = strtolower(substr($word, -1));
    switch ($lastChar) {
      case 's':
        if ($lastThreeChar === 'aux') {
          return substr($word, 0, -3) . 'al'; // cas particulier
        }
        return substr($word, 0, -1); // pluriel classique
      case 'x':
        return substr($word, 0, -1); // pluriel classique
      default:
        return $word; // singulier inchangé
    }
  }

?>