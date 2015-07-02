<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
{
	if ($length == 0)
		return '';
	if (mystrlen($string) > $length)
	{
		$length -= min($length, mystrlen($etc));
		if (!$break_words && !$middle)
		{
			$string = preg_replace('/\s+?(\S+)?$/', '', mysubstr($string, 0, $length +1));
		}
		if (!$middle)
		{
			return mysubstr($string, 0, $length) . $etc;
		}
		else
		{
			return mysubstr($string, 0, $length / 2) . $etc . mysubstr($string, - $length / 2);
		}
	}
	else
	{
		return $string;
	}
}

function mysubstr($str, $start, $len)
{
	$step = is_utf8($str) ? 2 : 1;
	$tmpstr = "";
	$strlen = $start + $len;
	for ($i = 0; $i < $strlen; $i++)
	{
		if (ord(substr($str, $i, 1)) > 0xa0)
		{
			$tmpstr .= substr($str, $i, $step +1);
			$i += $step;
			$strlen += $step;
		}
		else
			$tmpstr .= substr($str, $i, 1);
	}
	return $tmpstr;
}

function mystrlen($str)
{
	$step = is_utf8($str) ? 2 : 1;
	$strlen = $mystrlen = strlen($str);
	for ($i = 0; $i < $strlen; $i++)
	{
		if (ord(substr($str, $i, 1)) > 0xa0)
		{
			$mystrlen -= $step;
			$i += $step;
		}
	}
	return $mystrlen;
}

function is_utf8($string)
{

	// From http://w3.org/International/questions/qa-forms-utf-8.html
	return preg_match('%^(?:
	         [\x09\x0A\x0D\x20-\x7E]            # ASCII
	       | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
	       | \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
	       | \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	       | \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
	       | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	       | \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
	   )*$%xs', $string);

}

/* vim: set expandtab: */
?>
