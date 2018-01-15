<?php

class VigenèreCipher
{
    private $key;
    private $alphabet;

    public function __construct($key, $alphabet)
    {
        $this->key = $key;
        $this->alphabet = $alphabet;
    }

    public function encode($text)
    {
        $cipher = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $cipher .= $this->encodeLetter($text[$i], $i);
        }

        return $cipher;
    }

    public function decode($cipher)
    {
        $text = '';
        for ($i = 0; $i < strlen($cipher); $i++) {
            $text .= $this->decodeLetter($cipher[$i], $i);
        }

        return $text;
    }

    private function encodeLetter($letter, $position)
    {
        return $this->shiftLetter($letter, $this->getKeyShiftAtPosition($position));
    }

    private function shiftLetter($letter, $shiftSize)
    {
        $pos = strpos($this->alphabet, $letter);
        if ($pos === false) {
            return $letter;
        }

        $length = strlen($this->alphabet);
        $cipherLetterPos = ($pos + $shiftSize + $length) % $length;

        return $this->alphabet[$cipherLetterPos];
    }

    private function getKeyShiftAtPosition($position)
    {
        $keyLetter = $this->key[$position % strlen($this->key)];

        return strpos($this->alphabet, $keyLetter);
    }

    private function decodeLetter($letter, $position)
    {
        return $this->shiftLetter($letter, -$this->getKeyShiftAtPosition($position));
    }
}