<?php
/***************** 
 * 
Helper Functions @Nik
*
*************/

/**
 * Get Slug
 * @param  link|string $text
 * @return string
 */
function getSlug($text){ 
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    // trim
    $text = trim($text, '-');
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text))
    {
      return 'n-a';
    }
    return $text;
}

/**
 * prx
 * @param array $arr
 * @return array
 */
function prx($arr){
	echo "<pre>";
	print_r($arr);
	die();
}

/**
 * pr
 * @param array $arr
 * @return array
 */
function pr($arr){
	echo "<pre>";
	print_r($arr);
}

/**
 * Masked phone Number
 * @param array $string
 * @return string
 */
function maskedMobileNumber($number){
  if ($number=="") {
    return '';
  }
  $first_string ="";
  $length = strlen($number);
  if( $length < 3 ){
   return $length == 1 ? "*" : "*". substr($number,  - 1);
  }
  else{
     $part_size = floor($length/3);
     $first_part_size = $part_size * 2;
     for ($i=0; $i < $first_part_size; $i++) { 
       $first_string.= "*";
     }
     return $first_string. substr($number, -$part_size-1 );
  }
}

/**
 * Masked Email
 * @param array $string
 * @return string
 */
function maskedEmail($email){
  if(!filter_var($email, FILTER_VALIDATE_EMAIL) || '') return "Not Vaild email";

  list($first,$last) = explode('@',$email);
  $len  = floor(strlen($first)/2);
  $first = str_replace(substr($first, $len), str_repeat('*', strlen($first)-$len), $first);
  $first = str_replace(substr($first, '4'), str_repeat('*', strlen($first)-4), $first);
  $maskedEmail = $first.'@'.$last;
  return $maskedEmail;
}