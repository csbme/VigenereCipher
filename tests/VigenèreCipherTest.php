<?php

require __DIR__."/../src/VigenèreCipher.php";

use PHPUnit\Framework\TestCase;

/**
 * @covers VigenèreCipher
 */
class VigenèreCipherTest extends TestCase
{
    public function testCipherLenghtEqualsMessageLength()
    {
        $vc = new VigenèreCipher();
        $this->assertEquals('', $vc->generateKey(0));
        $this->assertEquals('p', $vc->generateKey(1));
        $this->assertEquals('password', $vc->generateKey(8));
        $this->assertEquals('passwordp', $vc->generateKey(9));
        $this->assertEquals('passwordpasswordpasswordpasswor', $vc->generateKey(31));
    }

    public function testAlphabetLengthIsValid()
    {
        $vc = new VigenèreCipher();
        $this->assertEquals(26, $vc->getAlphabetLength());
        $this->assertEquals(25, $vc->getAlphabetLength(1));
    }

    public function testEncode()
    {
        $vc = new VigenèreCipher();
        $this->assertEquals('rovwsoiv', $vc->encode('codewars'));

        $vc = new VigenèreCipher('math');
        $this->assertEquals('yadlutahbpxu', $vc->encode('makeithappen'));
    }

    public function testDecode()
    {
        $vc = new VigenèreCipher();
        $this->assertEquals('waffles', $vc->decode('laxxhsj'));

        $vc = new VigenèreCipher('math');
        $this->assertEquals('makeithappen', $vc->decode('yadlutahbpxu'));
    }
}
