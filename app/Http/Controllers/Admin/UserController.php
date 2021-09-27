<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$model = new User();
        return view('admin.user.index', [
			'UserList' => $model->all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $User = User::create([
			'name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'is_admin' => $request->is_admin
        ]);

		if( $User ) {
			return redirect()
				->route('admin.user.index')
				->with('success', trans(key:'messages.admin.user.create.success'));
		}

		return back()
			->with('error', __(key:'messages.admin.user.create.fail'))
			->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
			'user' => $user
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $User = $user->fill([
			'name' => $request->name, 'email' => $request->email, 'is_admin' => $request->is_admin
        ])->save();

		if( $User ) {
			return redirect()
				->route('admin.user.index')
				->with('success', trans(key:'messages.admin.user.update.success'));
		}

		return back()
			->with('error', __(key:'messages.admin.user.update.fail'))
			->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            //\Log::error(message:"Error delete News". PHP_EOL, [$e]);
        }
    }
}
