<?php declare(strict_types=1);

namespace App\Repository;

use MessageInfo\NumberListAPIDataProvider;

interface NumberListWriteRepositoryInterface
{
    public function insertCollection(NumberListAPIDataProvider $numberList);
}
