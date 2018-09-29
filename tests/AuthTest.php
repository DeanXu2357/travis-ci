<?php

/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 07:45
 */
namespace Tests {
    use App\AuthService;
    use App\FakeProfile;
    use App\FakeToken;
    use PHPUnit\Framework\TestCase;

    class AuthenticationServiceTest extends TestCase
    {
        /** @test */
        public function is_valid_test()
        {
            $target = new AuthService(new FakeProfile(), new FakeToken());
            $actual = $target->isValid('joey', '91000000');
            //always failed
            $this->assertTrue($actual);
        }
    }
}

namespace App {
    class FakeProfile implements \App\Interfaces\iProfile
    {
        public function getPassword($account)
        {
            if ($account == 'joey') {
                return '91';
            }
            return '';
        }
    }
    class FakeToken implements \App\Interfaces\iToken
    {
        public function getRandom($account)
        {
            return '000000';
        }
    }
}
