<?php


namespace App\ReadModels;


use App\Entity\User\User;

class UserReadRepository
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
{
    $this->user = $user;
}

    public function isAuth()
    {
        return auth()->user() ? true : false;
    }
}
