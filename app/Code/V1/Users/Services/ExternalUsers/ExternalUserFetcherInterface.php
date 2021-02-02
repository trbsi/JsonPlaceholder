<?php

namespace App\Code\V1\Users\Services\ExternalUsers;

interface ExternalUserFetcherInterface
{
    public function fetchUsersFromExternalSource(): void;
}