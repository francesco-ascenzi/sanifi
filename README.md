# Sanifi
Sanifi is an open source lightweight PHP class library to sanitize client inputs. It prevents XSS and SQL injection attacks, alongside prepared statement.

## Structure
Sanifi is basically a class with differents static methods, that returns: if the given data is valid and sanitized, errors, sanitized and validated data.

## Methods
Sanifi has 5 built-in methods to check and validate data.

**Email**: return validated and sanitized email address.  
**Number**: return validated and sanitized number.  
**String**: return validated and sanitized no whitespaces string.  
**Text**: return validated and sanitized text.  
**Uuid**: return validated and sanitized uuid.  

## How to use it
Call the relevant method (e.g. Email, Number, String, etc.) and pass availables options.

Example:

``` 
$res = Sanifi::Email($mail_to_sanitize, 6, 120);
```

## Options values
In order to return a customized value, you can set options.

### Email
Options:  
    \- **int** $min_length -> number  
    \- **int** $max_length -> number  

Function:
```
public static function Email($email, int $min_length = 6, int $max_length = 320) {}
```
Example of use:
```
Sanifi::Email("trythis@mail.com", 0, 120);
```

### Number
Options:  
    \- **float** $min_value - number  
    \- **float** $max_value - number  

Function:  
```
public static function Number($number, float $min_value = -1000, float $max_value = 1000) {}
```
Example of use:  
```
Sanifi::Number($number_to_sanitize, 0.2, 3000);
```

### String
Options:  
    \- **int** $min_length - number  
    \- **int** $max_length - number  
    \- **string** **case insensitive** $style - lower -> lowercase every character, upper -> uppercase every character, upperwords -> uppercase every first character (first character uppercase default)

Function:
```
public static function String($string, int $min_length = 0, int $max_length = 255, string $style = "") {}
```
Example of use:
```
Sanifi::Number($string_to_sanitize, 0.2, 3000, "lower");
```

### Text
Options:  
\- **int** $min_length - number  
\- **int** $max_length - number  
\- **int** $keep_break - boolean  

Function:
```
public static function Text($text, int $min_length = 4, int $max_length = 250, int $keep_break = 0) {}
```
Example of use:
```
Sanifi::Text($text_to_sanitize, 0, 3000, 1);
```

### Uuid
Function
```
public static function Uuid($uuid) {}
```

## Return
Every methods return an ```Array()``` with 4 associative values.

``` 
$res["passed"];
$res["function_error"];
$res["client_error"];
$res["data"];
```

## Passed
In order to check if value is valid and sanitized use ```$res["passed"]```.

Value -> 0 if there was an error, 1 if it's passed

## Server/Function error
If ```$res["passed"]``` return 0, you can understand with ```$res["function_error"]``` what's wrong with inputted data.

## Client error
If ```$res["passed"]``` return 0, you can show to the client with ```$res["function_error"]``` what's wrong with inputted data.

## Data
If ```$res["passed"]``` return 0, ```$res["data"]``` will be empty.  
If ```$res["passed"]``` return 1, ```$res["data"]``` will be filled with validated and sanitized given value.
