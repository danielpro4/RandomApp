<?php

namespace App\Http\Controllers;

use App\Contracts\UserInterface;
use App\Http\Requests\UserRequest;
use App\User;

class UsersController extends Controller
{

    /**
     * @var UserInterface
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserInterface $users
     */
    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $users = User::all();

        return view('users.index')->with(['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.form', [
            'user' => new User
        ]);
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request) {

        $this->users->store($request->all());

        return redirect()
            ->route('users.all')
            ->with('success', 'Usuario registrado correctamente');
    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(User $user)
    {
        return view('users.view', [
            'user'  => $user,
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $task
     */
    public function edit(User $user)
    {
        return view('users.form', [
            'user' => $user
        ]);
    }

    /**
     * @param UserRequest $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $user)
    {
        $user = $this->users->update($request->all(), $user);

        return redirect()->route('user.view', $user)
            ->with('user', $user)
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * @param $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($task)
    {
        $this->users->destroy($task);

        return redirect()
            ->route('users.all')
            ->with('success', 'Usuario eliminado correctamente');
    }

}
