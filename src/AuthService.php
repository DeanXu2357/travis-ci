<?php

namespace App;

use App\Interfaces\iProfile;
use App\Interfaces\iToken;
use App\Interfaces\ILogger;
use App\Utilities\ProfileDao;
use App\Utilities\RsaTokenDao;

class AuthService
{
    private $profile;
    private $token;
    private $logger;

    public function __construct(iProfile $profile = null, iToken $token = null, ILogger $logger = null)
    {
        $this->profile = $profile ?: new ProfileDao();
        $this->token = $token ?: new RsaTokenDao();
        $this->logger = $logger;// ?: new Logger();
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
            $this->logger->save(sprintf("account: %s try to login failed", $account));
            return false;
        }
    }
}
