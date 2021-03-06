<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Repository\NumberListWriteRepositoryInterface;
use MessageInfo\NumberListAPIDataProvider;

class NumberListMessageHandler
{
    /**
     * @var NumberListWriteRepositoryInterface
     */
    private NumberListWriteRepositoryInterface $numberListRepo;

    /**
     * @param NumberListWriteRepositoryInterface $numberListWriteRepository
     */
    public function __construct(
        NumberListWriteRepositoryInterface $numberListWriteRepository
    ) {
        $this->numberListRepo = $numberListWriteRepository;
    }

    public function __invoke(NumberListAPIDataProvider $message): void
    {
        try {
            $this->numberListRepo->insertCollection($message);
        } catch (\Throwable $e) {
            dump($e);
        }
    }
}
