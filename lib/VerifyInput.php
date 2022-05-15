<?php
namespace Lib;

class VerifyInput
{
    /*
     * @input -> string to verify
     */
    public static function verifyInput(string $input) : string
    {
        $input = trim($input);
        $input = stripcslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }
}
