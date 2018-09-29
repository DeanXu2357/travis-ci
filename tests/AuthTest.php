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
    use Mockery as m;
    use App\Interfaces\iProfile;
    use App\Interfaces\iToken;
    use App\Interfaces\ILogger;
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    class AuthenticationServiceTest extends TestCase
    {
        use MockeryPHPUnitIntegration;

        private $stubProfile;
        private $stubToken;
        private $mockLogger;
        private $target;

        protected function setUp()
        {
            parent::setUp();
            $this->stubProfile = m::mock(iProfile::class);
            $this->stubToken = m::mock(iToken::class);

            // $this->mockLogger = m::mock(ILogger::class);
            $this->mockLogger = m::spy(ILogger::class);

            $this->target = new AuthService(
                $this->stubProfile,
                $this->stubToken,
                $this->mockLogger
            );
        }

        /** @test */
        public function is_valid_test()
        {
            $this->givenPassword('joey', '91');
            $this->givenToken('000000');

            $this->shouldBeValid('joey', '91000000', true);
        }

        public function test_should_log_account_when_inValid()
        {
            # code
            $this->givenPassword('joey', '91');
            $this->givenToken('000000');

            $this->target->isValid('joey', 'wrong password');

            $this->shouldLog('joey');
        }

        public function shouldLog($account)
        {
            $this->mockLogger->shouldHaveReceived('save')->with(m::on(function ($message) use ($account) {
                return strpos($message, $account) !== false;
            }));
        }

        public function givenPassword($account, $setPass)
        {
            $this->stubProfile->shouldReceive('getPassword')
                ->with($account)
                ->andReturn($setPass);
        }

        public function givenToken($token)
        {
            $this->stubToken->shouldReceive('getRandom')
                ->andReturn($token);
        }

        public function shouldBeValid($account, $password, $expected)
        {
            $target = new AuthService($this->stubProfile, $this->stubToken);
            $actual = $target->isValid($account, $password);
            // $this->assertTrue($actual);
            $this->assertEquals($expected, $actual);
        }
    }
}

// namespace App {
//     class FakeProfile implements \App\Interfaces\iProfile
//     {
//         public function getPassword($account)
//         {
//             if ($account == 'joey') {
//                 return '91';
//             }
//             return '';
//         }
//     }
//     class FakeToken implements \App\Interfaces\iToken
//     {
//         public function getRandom($account)
//         {
//             return '000000';
//         }
//     }
// }
