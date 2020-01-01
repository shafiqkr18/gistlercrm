<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//change date format
if ( ! function_exists('gistler_dateformat'))
{
			function gistler_dateformat($originalDate,$format) {
			return date($format, strtotime($originalDate));
		} 
}
//check if there is no http in url,it will add
if ( ! function_exists('addhttp'))
{
			function addhttp($url) {
			if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
				$url = "http://" . $url;
			}
			return $url;
		} 
}

//remove strange characters

if ( ! function_exists('remove_strange_char'))
{
			function remove_strange_char($text)
	{
				$find[] = '“'; // left side double smart quote
			$find[] = '”'; // right side double smart quote
			$find[] = '‘'; // left side single smart quote
			$find[] = '’'; // right side single smart quote
			$find[] = '…'; // elipsis
			$find[] = '—'; // em dash
			$find[] = '–'; // en dash
			
			$replace[] = '"';
			$replace[] = '"';
			$replace[] = "'";
			$replace[] = "'";
			$replace[] = "...";
			$replace[] = "-";
			$replace[] = "-";
			return $text = str_replace($find, $replace, $text);

	}
}

// generate randome number----use random_string() in codeigniter instead of this
//https://ellislab.com/codeigniter/user-guide/helpers/string_helper.html
		if ( ! function_exists('random_number'))
		{
			function random_number($maxlength = 8) {
					$chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
									"0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
									"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
					$return_str = "";
					for ( $x=0; $x<=$maxlength; $x++ ) {
						$return_str .= $chary[rand(0, count($chary)-1)];
					}
					return $return_str;
				}
		}

//get date only
	if(!function_exists('getGistlerDate'))
	{
		function getGistlerDate($format,$dt)
		{
			return(date($format, strtotime($dt)));
		}
	}
	//get year only
	if(!function_exists('getGistlerYear'))
	{
		function getGistlerYear($dt)
		{
			return(date('Y', strtotime($dt)));
		}
	}
	//percentage
	function Gistler_percentage($val1, $val2, $precision) 
	{
	   $res = round( ($val1 / $val2) * 100, $precision );
	    return $res;
	}
	