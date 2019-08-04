<?php
   
interface ValidatorFactory
{
    public function makeValidator();
}

class Validator implements ValidatorFactory
{
    private $string;

    public function __construct($string)
    {
        $this->string = $this->clean($string);
    }

    /**
     * Clean string from non numeric chars
     *
     * @param  string $string
     *
     * @return string
     */
    private function countDigits($string)
    {
        return strlen($string);
    }

    private function clean($string)
    {
        return preg_replace('/[^A-Za-z0-9]/', '', $string);
    }
    /**
     * Instantiate object according number of digits
     *
     * @return void
     */
    public function makeValidator()
    {
        if (10 == $this->countDigits($this->string)) {
            return new Validator10($this->string);
        }

        if (13 == $this->countDigits($this->string)) {
            return new Validator13($this->string);
        }        
    }
}

/**
 * Validate 10 digits code
 * 
 */
class Validator10
{
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }
    
    /**
     * Validate according instructions
     *
     * @return bool
     */
    public function validate()
    {
        $s = 0;
        $string = $this->string;

        for ($i=0;$i<9;$i++) {
            $ord = $i+1;
            $s = $s + $ord*$string[$i];
        }
        $check = substr($string, -1);
        if ($s % 11 == 10 && $check == 'X') {
            return true;
        }
        if ($s % 11 == $check) {
            return true;
        }
        
        return false;        
   }
}

/**
 * Validate 13 digits code
 * 
 */
class Validator13
{
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }
    
    /**
     * Validate according instructions
     *
     * @return bool
     */
    public function validate()
    {
        $s = 0;
        $string = $this->string;

        for ($i=0;$i<12;$i++) {
            if ($i % 2 == 0) {
                $ord = 1;
            } else {
                $ord = 3;
            }
            $s = $s + $ord*$string[$i];
        }
        $check = substr($string, -1) ;

        if ($check == (10 - ($s % 10))%10) {
            return true;
        } else {
            return false;
        }    
   }
}


/**
 * Apply validator on string and return message
 *
 * @param  string $cleanString
 *
 * @return string
 */
function validateString ($cleanString) {
    $factory = new Validator($cleanString);
    $validator = $factory->makeValidator();

    if (!isset($validator)) {
        return 'Invalid code!';
    }
    
    $result = $validator->validate();
    if ($result) {
        return 'Valid code';
    } else {
        return 'Invalid code!';
    }  
}

$string = $_SERVER["argv"][1] ;
echo validateString($string);

?>