<?php

class Img{

	static function creerMin($img,$chemin,$nom,$mlargeur=100,$mhauteur=100){
		// On supprime l'extension du nom
		$nom = substr($nom,0,-4);
		// On récupère les dimensions de l'image
		$dimension=getimagesize($img);
		// On cré une image à partir du fichier récup
		if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
		else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
		else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
		// L'image ne peut etre redimensionne
		else{return false; }
		
		// Création des miniatures
		// On cré une image vide de la largeur et hauteur voulue
		$miniature =imagecreatetruecolor ($mlargeur,$mhauteur); 
		// On va gérer la position et le redimensionnement de la grande image
		if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
		if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
		if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
		// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
			// Convertir les valeurs à virgule flottante en entiers de manière explicite
			$decalXInt = (int)$decalX;
			$decalYInt = (int)$decalY;
			$dimXInt = (int)$dimX;
			$dimYInt = (int)$dimY;
			$dimension0Int = (int)$dimension[0];
			$dimension1Int = (int)$dimension[1];
		imagecopyresampled($miniature,$image,$decalXInt,$decalYInt,0,0,$dimXInt,$dimYInt,$dimension0Int,$dimension1Int);
		// On sauvegarde le tout
		imagejpeg($miniature,$chemin."/".$nom.".jpg",90);
		return true;
	}
	

	static function convertirJPG($img){
		// On cré une image à partir du fichier récup
		if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
		else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
		else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
		// L'image ne peut etre redimensionne
		else{return false; }
		unlink($img);
		imagejpeg($image,substr($img,0,-3)."jpg",90);	
		return true;
	}
}

?>
