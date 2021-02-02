<?php

namespace App\Code\V1\Users\Services;

use App\Code\V1\Users\Repositories\UserRepository;
use App\Code\V1\Users\Services\ExternalUsers\ExternalUserFetcherInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

final class UsersFetcher
{
    private const USER_CACHE_KEY = 'user_cache_time';

    /**
     * @var ExternalUserFetcherInterface
     */
    private ExternalUserFetcherInterface $externalUsers;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(
        ExternalUserFetcherInterface $externalUsers,
        UserRepository $userRepository
    ) {
        $this->externalUsers = $externalUsers;
        $this->userRepository = $userRepository;
    }

    public function fetchUsers(int $id, ?string $email): Collection
    {
        $this->cacheUsers();
        return $this->userRepository->getUserByIdAndEmail($id, $email);
    }

    private function cacheUsers()
    {
        $cacheTime = Cache::get(self::USER_CACHE_KEY);
        if (null === $cacheTime) {
            $this->externalUsers->fetchUsersFromExternalSource();
            Cache::set(UsersFetcher::USER_CACHE_KEY, true, 60);
        }
    }
}