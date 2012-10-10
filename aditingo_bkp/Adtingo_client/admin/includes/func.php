<?php
define ("MAX_SIZE",1000000);
	define ("WIDTH","83"); //set here the width you want your thumbnail to be
	define ("HEIGHT","100"); //set here the height you want your thumbnail to be.
	define ("WIDTH2","483"); //set here the width you want your thumbnail to be
	define ("HEIGHT2","594"); //set here the height you want your thumbnail to be.
function make_thumb($img_name,$filename,$new_w,$new_h){
			//echo $img_name."<br>".$filename."<br>";
		$ext=getExtension($img_name);
		//creates the new image using the appropriate function from gd library
		if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
			$src_img=imagecreatefromjpeg($img_name);
			//echo $src_img;
		if(!strcmp("png",$ext))
			$src_img=imagecreatefrompng($img_name);
		if(!strcmp("gif",$ext))
			$src_img=imagecreatefromgif($img_name);
		//gets the dimmensions of the image
		$old_x=imagesx($src_img);
		$old_y=imagesy($src_img);
		
		$ratio1=$old_x/$new_w;
		$ratio2=$old_y/$new_h;
		if($ratio1>$ratio2) {
			$thumb_w=$new_w;
			$thumb_h=$old_y/$ratio1;
		}else{
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio2;
		}
		// we create a new image with the new dimmensions
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		// resize the big image to the new created one
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		// output the created image to the file. Now we will have the thumbnail into the file named by $filename
		if(!strcmp("png",$ext))
			imagepng($dst_img,$filename);
		else
			imagejpeg($dst_img,$filename);
		if (!strcmp("gif",$ext))
			imagegif($dst_img,$filename);
		//destroys source and destination images.
		imagedestroy($dst_img);
		imagedestroy($src_img);
	}// end function
function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	?>
