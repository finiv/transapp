<?php

namespace Tests\Unit;
use App\{User, Transaction};

use PHPUnit\Framework\TestCase;

class BalanceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
            $request = [
                'type' => 0,
                'amount' => 5444
            ];

        $this->assertTrue($this->checkBalance($request));
    }

    private function checkBalance($request)
    {
        $balance = 2815;
        if($request['type'] == 1){
            $result = $balance + $request['amount'];
        }else{
            $result = $balance - $request['amount'];
        }
       
        $expectedValue = -2629;

        return $expectedValue = $result;
    }
}
