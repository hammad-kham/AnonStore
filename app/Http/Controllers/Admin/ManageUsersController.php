<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ManageUsersRepositoryInterface;

class ManageUsersController extends Controller
{
    protected $userRepository;

    public function __construct(ManageUsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.manageUsers.index', compact('users'));
    }
}
