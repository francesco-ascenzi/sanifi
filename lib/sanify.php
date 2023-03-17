<?php 

/** SANIFY CLASS
 * 
 * @author Francesco "Frash" Ascenzi | Open-source
 * 
**/
class Sanify {

    /* Sanitize email */
    public static function Email($email, int $minlength = 6, int $maxlength = 320) {
        if (gettype($email) !== "string" || $email == "") return null;

        if (strlen($email) < $minlength || strlen($email) > $maxlength) return null;

        if ($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            return null;
        }
    }

    /* Sanitize numbers */
    public static function Number($number, int $min = -1000, int $max = 1000, int $zeroreturn = 0) {
        if (gettype($number) == "integer") {
            if ($number < $min || $number > $max) return null;

            if ((int)$number === 0 && $zeroreturn == 1) {
                return 0;
            } else if ((int)$number === 0 && $zeroreturn == 0) {
                return null;
            } else {
                return (int)$number;
            }
        } else if (gettype($number) == "double") {
            if ($number < $min || $number > $max) return null;

            if ((double)$number === 0 && $zeroreturn == 1) {
                return 0;
            } else if ((double)$number === 0 && $zeroreturn == 0) {
                return null;
            } else {
                return (double)$number;
            }
        } else {
            return null;
        }
    }

    /* Sanitize string */
    public static function String($string, string $style = "", int $min = 0, int $max = 255) {
        if (gettype($string) !== "string") return null;

        $match = null;
        if (preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]+$/', $string, $match) !== 0) {
            switch ($style) {
                case 'lower':
                    return strtolower($match[0]);
                break;
                case 'upper':
                    return strtoupper($match[0]);
                break;
                case 'upperWords':
                    return ucwords(strtolower($match[0]));
                break;
                default:
                    return ucfirst(strtolower($match[0]));
                    break;
            }
        }
        return null;
    }

    public static function Text() {

    }

    public static function uuid() {

    }
}