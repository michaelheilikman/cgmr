<?php

class Img {

    static function creerMin($img, $chemin, $nom, $mlargeur=100, $mhauteur=100) {
        // On récupère les dimensions de l'image
        $dimension = getimagesize($img);

        // On crée une image à partir du fichier récupéré
        if(substr(strtolower($img), -4) == ".jpg") {
            $image = imagecreatefromjpeg($img);
        } elseif(substr(strtolower($img), -4) == ".png") {
            $image = imagecreatefrompng($img);
            imagealphablending($image, true);
        } elseif(substr(strtolower($img), -4) == ".gif") {
            $image = imagecreatefromgif($img);
            // Maintenir la transparence pour les GIFs
            $transparentIndex = imagecolortransparent($image);
            if ($transparentIndex >= 0) {
                $transparentColor = imagecolorsforindex($image, $transparentIndex);
            }
        } else {
            return false; // L'image ne peut être redimensionnée
        }

        // Création des miniatures
        $miniature = imagecreatetruecolor($mlargeur, $mhauteur);

        // Activation de la transparence pour PNG et GIF
        imagealphablending($miniature, false);
        imagesavealpha($miniature, true);

        // Définition de la couleur transparente pour PNG et GIF
        if (isset($transparentColor)) {
            $transparentIndex = imagecolorallocate($miniature, $transparentColor['red'], $transparentColor['green'], $transparentColor['blue']);
            imagefill($miniature, 0, 0, $transparentIndex);
            imagecolortransparent($miniature, $transparentIndex);
        }
        // On va gérer la position et le redimensionnement de la grande image
        if($dimension[0] > ($mlargeur / $mhauteur) * $dimension[1]) {
            $dimY = $mhauteur; 
            $dimX = $mhauteur * $dimension[0] / $dimension[1]; 
            $decalX = -($dimX - $mlargeur) / 2; 
            $decalY = 0;
        } elseif($dimension[0] < ($mlargeur / $mhauteur) * $dimension[1]) {
            $dimX = $mlargeur; 
            $dimY = $mlargeur * $dimension[1] / $dimension[0]; 
            $decalY = -($dimY - $mhauteur) / 2; 
            $decalX = 0;
        } else {
            $dimX = $mlargeur; 
            $dimY = $mhauteur; 
            $decalX = 0; 
            $decalY = 0;
        }

        // Convertir les valeurs à virgule flottante en entiers de manière explicite
        $decalXInt = (int)$decalX;
        $decalYInt = (int)$decalY;
        $dimXInt = (int)$dimX;
        $dimYInt = (int)$dimY;
        $dimension0Int = (int)$dimension[0];
        $dimension1Int = (int)$dimension[1];

        imagecopyresampled($miniature, $image, $decalXInt, $decalYInt, 0, 0, $dimXInt, $dimYInt, $dimension0Int, $dimension1Int);

         // On sauvegarde le tout
		 if (substr(strtolower($img), -4) == ".png") {
            imagepng($miniature, $chemin . "/" . $nom);
        } elseif (substr(strtolower($img), -4) == ".gif") {
            imagegif($miniature, $chemin . "/" . $nom);
        } else {
            imagejpeg($miniature, $chemin . "/" . $nom, 90);
        }

        return true;
    }
}