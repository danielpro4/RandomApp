<?php

namespace App\Contracts;

interface UserInterface
{
    /**
     * Returns Eloquent Builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder();

    /**
     * Returns a task by its primary key.
     *
     * @param  int  $id
     * @return Task
     */
    public function find($id);

    /**
     * Returns all users.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll();

    /**
     * Returns all active users.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllActive();

    /**
     * Creates a new task with the given data.
     *
     * @param  array $input
     * @return User
     */
    public function store(array $input);

    /**
     * Updates the given task with the given data.
     *
     * @param  array $input
     * @param  int  $userid
     * @return User
     */
    public function update(array $input, $userid);

    /**
     * Deletes the given task.
     *
     * @param  int|User  $id
     * @return bool
     */
    public function destroy($id);
}
