<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\ManageUsersRepositoryInterface;
use Illuminate\Support\Collection;

class ManageUsersRepository implements ManageUsersRepositoryInterface
{
    public function all(): Collection
    {
        return User::all();
    }


}
