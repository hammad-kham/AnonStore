<?php
namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface ManageUsersRepositoryInterface
{
    public function all(): Collection;

    // You can define other methods as needed
}
