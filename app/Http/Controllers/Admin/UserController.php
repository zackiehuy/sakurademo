<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Contracts\IUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    protected $userRepository;


    public function __construct(IUser  $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->userRepository->datatable();
        }
        return view('front-end.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['menuroles'] = 'user,admin';
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        $data['email_verified_at'] = now();
        $user = $this->userRepository->create($data);
        $user->assignRole('admin');
        $user->assignRole('user');
        return [
            'title' => trans('base.success'),
            'status' => '200',
            'message' => trans('base.add_success', ['item' => trans('base.user_header')])
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = $this->userRepository->find($id);
        if($request->ajax())
        {
            if (!isset($user)) {
                return [
                    'title' => trans('base.warning'),
                    'row_id' => $id,
                    'status'   => 500,
                    'message' => trans('base.not_existed', ['item' => trans('base.user')])
                ];
            }
            return $user;
        }
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->find($id);
        if (!isset($user)) {
            return [
                'title' => trans('base.warning'),
                'status'   => '500',
                'message' => trans('base.not_existed', ['item' => trans('base.user')])
            ];
        }
        $data = $request->except('_token', '_method');
        $user->update($data);
        return [
            'title' => trans('base.success'),
            'status' => '200',
            'message' => trans('base.update_success', ['item' => trans('base.user_header')])
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);
        if (!isset($user)) {
            return [
                'title' => trans('base.warning'),
                'status'   => '500',
                'not_exist'   => true,
                'row_id' => $id,
                'message' => trans('base.not_existed', ['item' => trans('base.user')])
            ];
        }
        if ($id == 1) {
            return [
                'title' => trans('base.error'),
                'status'   => '500',
                'not_exist'   => false,
                'row_id' => $id,
                'message' => trans('base.delete_fail', ['item' => trans('base.user_header')])
            ];
        }
        $user->delete();
        return [
            'title' => trans('base.success'),
            'status' => '200',
            'row_id' => $id,
            'message' => trans('base.delete_success', ['item' => trans('base.user_header')])
        ];
    }

    public function ChangePassword($id, ChangePasswordRequest $request)
    {
        $user = $this->userRepository->find($id);
        if (!isset($user)) {
            return [
                'title' => trans('base.warning'),
                'status'   => '500',
                'row_id' => $id,
                'message' => trans('base.not_existed', ['item' => trans('base.user')])
            ];
        }
        $password = Hash::make($request->input('password'));
        $user->update(['password' => $password]);
        return [
            'title' => trans('base.success'),
            'status' => '200',
            'message' => trans('base.update_success', ['item' => trans('base.user_header')])
        ];
    }
}
