<?php

namespace Stayallive\Laravel\Passport\Memoized;

use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class MemoizedClientRepository extends ClientRepository implements MemoizedRepository
{
    private array $cache = [];

    public function find($id): ?Client
    {
        if (!isset($this->cache[$id])) {
            $this->cache[$id] = parent::find($id);
        }

        return $this->cache[$id];
    }

    public function findForUser($clientId, $userId): ?Client
    {
        $client = $this->find($clientId);

        return $client !== null && $client->user_id === $userId
            ? $client
            : null;
    }

    public function personalAccessClient(): Client
    {
        $client = parent::personalAccessClient();

        if ($client !== null) {
            $this->cache[$client->id] = $client;
        }

        return $client;
    }

    public function update(Client $client, $name, $redirect): Client
    {
        $client = parent::update($client, $name, $redirect);

        $this->cache[$client->id] = $client;

        return $client;
    }

    public function regenerateSecret(Client $client): Client
    {
        $client = parent::regenerateSecret($client);

        $this->cache[$client->id] = $client;

        return $client;
    }

    public function delete(Client $client): void
    {
        unset($this->cache[$client->id]);

        parent::delete($client);
    }

    public function clearInternalCache(): void
    {
        $this->cache = [];
    }
}
