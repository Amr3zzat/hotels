<?php
declare(strict_types=1);

namespace App\Services;


interface HotelsProviderInterface
{
    public function search($filters): ?array;

}
