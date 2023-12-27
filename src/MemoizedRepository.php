<?php

namespace Stayallive\Laravel\Passport\Memoized;

interface MemoizedRepository
{
    public function clearInternalCache(): void;
}
