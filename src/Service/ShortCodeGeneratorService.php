<?php

namespace App\Service;

use App\Repository\LinksRepository;

class ShortCodeGeneratorService
{
    private const ALPHABET = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    private const LENGTH = 7;

    public function __construct(private LinksRepository $linksRepository) {}

    public function generate(): string
    {
        do {
            $code = $this->randomCode();
        } while ($this->linksRepository->findOneBy(['shortCode' => $code]) !== null);

        return $code;
    }

    private function randomCode(): string
    {
        $alphabetLength = strlen(self::ALPHABET);
        $code = '';

        for ($i = 0; $i < self::LENGTH; $i++) {
            $code .= self::ALPHABET[random_int(0, $alphabetLength - 1)];
        }

        return $code;
    }
}
