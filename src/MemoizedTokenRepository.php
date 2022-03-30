<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

class MemoizedTokenRepository extends TokenRepository
{
    private array $cache = [];

    public function find($id): ?Token
    {
        if (!isset($this->cache[$id])) {
            $this->cache[$id] = parent::find($id);
        }

        return $this->cache[$id];
    }

    public function findForUser($id, $userId): ?Token
    {
        $token = $this->find($id);

        return $token !== null && $token->user_id === $userId
            ? $token
            : null;
    }

    public function save(Token $token): void
    {
        parent::save($token);

        $this->cache[$token->id] = $token;
    }

    public function revokeAccessToken($id): bool
    {
        unset($this->cache[$id]);

        return parent::revokeAccessToken($id);
    }
}
