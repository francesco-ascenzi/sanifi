<?php 

/** 
 * 
 * SANIFI CLASS
 * 
 * This is a lightweight class to sanitize data inputs from client
 * 
 * @author Francesco "Frash" Ascenzi
 * @copyright Apache 2.0
 * 
 * @method Email() | Validate and sanitize email address
 * @method Number() | Validate and sanitize number
 * @method String() | Validate and sanitize string
 * @method Text() | Validate and sanitize text
 * @method Uuid() | Validate and sanitize uuid
 * 
 * @version 1.0
 * 
**/

class Sanifi {

    // ________

    public static function Email($email, int $min_length = 6, int $max_length = 320) {
        $resp = array("passed" => 0, "function_error" => "", "client_error" => "", "data" => "");

        if (gettype($email) !== "string" || $email === "") {
            $resp["function_error"] = "Type error: " . gettype($email);
            $resp["client_error"] = "You inserted an invalid value";
            return $resp;
        }

        if (strlen($email) < $min_length) {
            $resp["function_error"] = "Length error: " . strlen($email) . " characters long";
            $resp["client_error"] = "You entered a short email address";
            return $resp;
        } else if (strlen($email) > $max_length) {
            $resp["function_error"] = "Length error: " . strlen($email) . " characters long";
            $resp["client_error"] = "You entered a long email address";
            return $resp;
        }

        if ($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $resp["passed"] = 1;
            $resp["data"] = $email;
            return $resp;
        }
        
        $resp["function_error"] = "Invalid email characters";
        $resp["client_error"] = "Email inserted contains invalid characters";
        return $resp;

    }

    // ________

    public static function Number($number, int $min = -1000, int $max = 1000) {
        $resp = array("passed" => 0, "function_error" => "", "client_error" => "", "data" => "");

        if (!in_array(gettype($number), array("integer", "double"))) {
            $resp["function_error"] = "Type error: " . gettype($number);
            $resp["client_error"] = "You inserted an invalid number";
            return $resp;
        }

        if ($number < $min) {
            $resp["function_error"] = "Length error: " . $number;
            $resp["client_error"] = "You entered a too low number";
            return $resp;
        } else if ($number > $max) {
            $resp["function_error"] = "Length error: " . $number;
            $resp["client_error"] = "You entered a too high number";
            return $resp;
        }

        $resp["passed"] = 1;

        if (gettype($number) === "integer") {
            $resp["data"] = (int)$number;
        }
        $resp["data"] = (double)$number;

        return $resp;

    }

    // ________

    public static function String($string, string $style = "", int $min = 0, int $max = 255) {
        $resp = array("passed" => 0, "function_error" => "", "client_error" => "", "data" => "");

        if (gettype($string) !== "string") {
            $resp["function_error"] = "Type error: " . gettype($string);
            $resp["client_error"] = "You inserted an invalid text";
            return $resp;
        }

        $match = null;
        if (preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]+$/', $string, $match) !== 0) {

            $resp["passed"] = 1;

            switch ($style) {
                case 'lower':
                    $resp["data"] = strtolower($match[0]);
                    return $resp;
                break;
                case 'upper':
                    $resp["data"] = strtoupper($match[0]);
                    return $resp;
                break;
                case 'upperWords':
                    $resp["data"] = ucwords(strtolower($match[0]));
                    return $resp;
                break;
                default:
                    $resp["data"] = ucfirst(strtolower($match[0]));
                    return $resp;
                break;
            }

        }

        $resp["function_error"] = "Invalid string characters";
        $resp["client_error"] = "Text inserted contains invalid characters";
        return $resp;

    }

    // ________

    public static function Text($text, int $min = 4, int $max = 250, int $keep_break = 0) {
        $resp = array("passed" => 0, "function_error" => "", "client_error" => "", "data" => "");

        if (gettype($text) !== "string" || $text === "") {
            $resp["function_error"] = "Type error: " . gettype($text);
            $resp["client_error"] = "You inserted an invalid text";
            return $resp;
        }

        if (strlen($text) <= $min) {
            $resp["function_error"] = "Length error: " . strlen($text) . " characters long";
            $resp["client_error"] = "You entered a too short text";
            return $resp;
        } else if (strlen($text) >= $max) {
            $resp["function_error"] = "Length error: " . strlen($text) . " characters long";
            $resp["client_error"] = "You entered a too long text";
            return $resp;
        }

        if (preg_match('/^[A-Za-z]/', $text) === 0) {
            $resp["function_error"] = "First character error: #" . $text . "#";
            $resp["client_error"] = "First character must be a letter";
            return $resp;
        }

        $text = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);

        $text = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $text);

        $text = strip_tags($text);
    
        if ($keep_break === 0) {
            $text = preg_replace('/[\r\n\t ]+/', ' ', $text);
        }
        
        $text = trim($text);

        $text = str_replace("<\n", "&lt;\n", $text);

        $found = false;
        while (preg_match('/%[a-f0-9]{2}/i', $text, $match) ) {
		    $text = str_replace($match[0], '', $text);
		    $found = true;
	    }

	    if ($found) {
            $text = trim( preg_replace('/ +/', ' ', $text));
        }

        $resp["passed"] = 1;
        $resp["data"] = $text;
        return $resp;

    }

    // ________

    public static function Uuid($uuid) {
        $resp = array("passed" => 0, "function_error" => "", "client_error" => "", "data" => "");

        if (gettype($uuid) !== "string" || $uuid === "") {
            $resp["function_error"] = "Type error: " . gettype($uuid);
            $resp["client_error"] = "You inserted an invalid text";
            return $resp;
        }

        $match = null;
        if (preg_match('/^[a-zA-Z0-9]{8}[\-]{1}[a-zA-Z0-9]{4}[\-]{1}[a-zA-Z0-9]{4}[\-]{1}[a-zA-Z0-9]{4}[\-]{1}[a-zA-Z0-9]{12}$/', $uuid, $match) === 0) {
            $resp["function_error"] = "Invalid uuid: " . gettype($uuid);
            $resp["client_error"] = "You inserted an invalid uuid";
            return $resp;
        } else {
            $resp["passed"] = 1;
            $resp["data"] = $match[0];
            return $resp;
        }

    }

    // ________

}
