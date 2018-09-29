<?php

namespace App;

use App\Interfaces\iProfile;
use App\Interfaces\iToken;
use App\Utilities\ProfileDao;
use App\Utilities\RsaTokenDao;

class AuthService
{
    private $profile;
    private $token;

    public function __construct(iProfile $profile = null, iToken $token = null)
    {
        $this->profile = $profile ?: new ProfileDao();
        $this->token = $token ?: new RsaTokenDao();
    }

    public function isValid($account, $password)
    {
        # get password by account
        // $profileDao = new ProfileDao();
        $passwordFromDao = $this->profile->getPassword($account);
        # get Rsa token by account
        // $rsaToken = new RsaTokenDao();
        $randomCode = $this->token->getRandom($account);

        var_dump($randomCode);

        # authencation
        $validPassword = $passwordFromDao . $randomCode;
        $isValid = $validPassword === $password;

        if ($isValid) {
            return true;
        } else {
            return false;
        }
    }
}
