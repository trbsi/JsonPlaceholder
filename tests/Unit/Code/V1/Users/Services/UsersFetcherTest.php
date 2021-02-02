<?php

namespace Tests\Unit\Code\V1\Users\Services;

use App\Code\V1\Users\Repositories\UserRepository;
use App\Code\V1\Users\Services\ExternalUsers\ExternalUserFetcherInterface;
use App\Code\V1\Users\Services\UsersFetcher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Mockery\MockInterface;
use Tests\TestCase;

class UsersFetcherTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_fetch_users_when_external_source_is_called()
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('user_cache_time')
            ->andReturn(null);

        Cache::shouldReceive('set')
            ->once()
            ->with('user_cache_time', true, 60);

        $externalUsers = $this->partialMock(ExternalUserFetcherInterface::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('fetchUsersFromExternalSource')
                ->once();
        });

        $userRepository = $this->partialMock(UserRepository::class, function (MockInterface $mock) {
            $collection = new Collection();
            $mock
                ->shouldReceive('getUserByIdAndEmail')
                ->once()
                ->with(0, null)
                ->andReturn($collection);
        });
        $service = $this->getService($externalUsers, $userRepository);
        $service->fetchUsers(0, null);
    }

    public function test_fetch_users_when_external_source_is_not_called()
    {
        Cache::shouldReceive('get')
            ->once()
            ->with('user_cache_time')
            ->andReturn(true);

        $externalUsers = $this->partialMock(ExternalUserFetcherInterface::class);

        $userRepository = $this->partialMock(UserRepository::class, function (MockInterface $mock) {
            $collection = new Collection();
            $mock
                ->shouldReceive('getUserByIdAndEmail')
                ->once()
                ->with(0, null)
                ->andReturn($collection);
        });
        $service = $this->getService($externalUsers, $userRepository);
        $service->fetchUsers(0, null);
    }

    private function getService(ExternalUserFetcherInterface $externalUsers, UserRepository $userRepository): UsersFetcher
    {
        return new UsersFetcher(
            $externalUsers,
            $userRepository
        );

    }
}
