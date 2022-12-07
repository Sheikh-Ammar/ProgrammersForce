<?php

class Calculator
{
    // VARIABLES
    public $number1;
    public $number2;
    public $operator;

    // CONSTRUCTOR
    function __construct($num1, $num2, $operator)
    {
        $this->number1 = $num1;
        $this->number2 = $num2;
        $this->opertaor = $operator;
    }

    // METHIOD RETURN RESULT
    function calculate_result()
    {
        switch ($this->opertaor) {
            case '*':
                return $this->number1 * $this->number2;
                break;
            case '/':
                if ($this->number2 == 0) {
                    return -1;
                } else {
                    return $this->number1 / $this->number2;
                }
                break;
            case '-':
                return $this->number1 - $this->number2;
                break;
            case '+*':
                return $this->number1 + $this->number2;
                break;
            default:
                return "0";
                break;
        }
    }

    // DISPLAY calculate_result
    function result()
    {
        echo $this->calculate_result();
    }
}

// OBJECT OF CALCULATOR CLASS
$cal = new Calculator(2, 3, '*');
$cal->result();
