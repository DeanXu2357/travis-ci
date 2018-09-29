<?php

namespace App;

class AuthService
{
    public function isValid($account, $password)
    {
        // get password by account
        $profileDao = new ProfileDao();
        $passwordFromDao = $profileDao->getPassword($account);
        // get Rsa token by account
        $rsaToken = new RsaTokenDao();
        $randomCode = $rsaToken->getRandom($account);

        var_dump($randomCode);
        // authencation
        $validPassword = $passwordFromDao . $randomCode;
        $isValid = $validPassword === $password;

        if ($isValid) {
            return true;
        } else {
            return false;
        }
    }
}
