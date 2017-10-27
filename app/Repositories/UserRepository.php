<?php

namespace App\Repositories;

use App\Contracts\UserInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface {

    /**
     * Returns Eloquent Builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder()
    {
        // TODO: Implement builder() method.
    }

    /**
     * Returns a task by its primary key.
     *
     * @param  int $id
     * @return Task
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Returns all users.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * Returns all active users.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllActive()
    {
        // TODO: Implement findAllActive() method.
    }

    /**
     * Creates a new task with the given data.
     *
     * @param  array $input
     * @return User
     */
    public function store(array $input) {

        $user = new User();
        $user->fill(array_only($input, $user->getFillable()));
        $user->is_active = 1;
        $user->password = Hash::make('123456');
        $user->save();

        return $user;
    }

    /**
     * Updates the given task with the given data.
     *
     * @param  array $input
     * @param  User $userid
     * @return User
     */
    public function update(array $input, $userid) {
       $user = User::find($userid);

       $user->fill(array_only($input, $user->getFillable()))->save();

       return $user;
    }

    /**
     * Deletes the given task.
     *
     * @param  int|User $id
     * @return bool
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}