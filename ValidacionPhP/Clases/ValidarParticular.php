<?php

class ValidarParticular{

    public function __construct(){}

    public function validateALL($Particular){

        $error[] = $this->validateLetter($Particular->getName());
        $error[] = $this->validateLetter($Particular->getLastName());
        $error[] = $this->validateAddress($Particular->getAddress());
        $error[] = $this->validateEmail($Particular->getEmail());
        $error[] = $this->validatePassword($Particular->getPassword());
        $error[] = $this->validatePhone($Particular->getPhone());
        $error[] = $this->validateDNI($Particular->getDNI());
        return $error;
    }
    public function validateLetter($text): string
    {
        $pattern = '/^[A-Za-z ]{1,30}$/';
        if (empty($text))
            return "El campo no puede estar vacio";
        else if (!preg_match($pattern, $text))
            return "El campo solo puede contener letras";
        else
            return "Correcto";
    }

    public function validateAddress($address): string
    {
        $pattern = '/^[A-Za-z ][0-9]{1,30}$/';
        if (empty($address))
            return "El campo no puede estar vacio";
        else if (!preg_match($pattern, $address))
            return "El campo solo puede contener letras";
        else
            return "Correcto";
    }

    public function validateEmail($email): string
    {
        if (empty($email))
            return "El campo no puede estar vacío";
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return "El email no es correcto";
        else
            return "Correcto";
    }

    public function validatePhone($phone): string
    {
        if ($phone < 600000000 || $phone > 999999999)
            return "Numero incorrecto";
        else
            return "Correcto";
    }
    public function validateDNI($dni): string
    {
        $dniLetters = ["T", "R", "W", "A", "G", "M", "Y", "F", "P",
            "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];
        $dniN = intval(substr($dni, 0, 8));
        $dniL = substr($dni, 8, 1);
        if (empty($dni))
            return "El campo no puede estar vacío";


        else if($dniN <= 99999999 && $dniN >= 10000000) {
            $residuo = $dniN % 23;
            $key = $dniLetters[$residuo];

            if ($key == $dniL )
                return "Correcto";
            else
                return "El DNI es incorrecto";
        }
        else
            return "El DNI es incorrecto";
    }
    function validatePassword($password): string {
        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/";

        if (empty($password))
            return "El campo no puede estar vacío";
        else if (preg_match($pattern, $password))
            return "Correcto";
         else
            return "La contraseña es incorrecta";
    }
}