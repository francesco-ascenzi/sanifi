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
Call the relevant method (e.g. Email, Number, String, etc.) in this way:

``` 
$res = Sanifi::RelevantMethod($value, $options);
```

$value = raw data getted from client inputs  
$options = every methods has its own options, check options section down below

Example of use:

``` 
$res = Sanifi::Email($mail_to_sanitize, 6, 120);
```

## Options values
In order to customize personal use of Sanifi, you can choose some attributes to set as a options.

### Email
```
$res = Sanifi::Email($email_to_sanitize, $min_length, $max_length);
```
**int** $min_length
**int** $max_length

Example:
```
Sanifi::Email("trythis@mail.com", 0, 120);
```
### Number
```
$res = Sanifi::Number($number_to_sanitize, $min_value, $max_value);
```
**float** $min_value
**float** $max_value

Example:
```
Sanifi::Number($number_to_sanitize, 0.2, 3000);
```
### String
```
$res = Sanifi::String($string_to_sanitize, $min_length, $max_length, $style);
```
**int** $min_length
**int** $max_length
**string** $style  
    \- Default: First character uppercase  
    \- "lower": Lowercase every character  
    \- "upper": Uppercase every character  
    \- "upperWords": Uppercase every first character  

Example:
```
Sanifi::Number($number_to_sanitize, 0.2, 3000);
```
### Text
```
$res = Sanifi::Text($text_to_sanitize, $min_length, $max_length, $keep_break);
```
**int** $min_length
**int** $max_length
**int** $keep_break
### Uuid
```
$res = Sanifi::Uuid($uuid_to_sanitize);
```

## Return
Check for returning data:

``` 
$res["passed"];
$res["function_error"];
$res["client_error"];
$res["data"];
```
