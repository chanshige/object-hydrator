<?php

/*
 * This file is part of the chanshige/object-hydrator package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chanshige\Hydrator;

use Chanshige\Hydrator\Exception\LogicException;

interface HydrationInterface
{
    /**
     * @throws LogicException
     */
    public function hydrate(mixed $data, string $className);
}
