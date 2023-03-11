<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountProfileRequest;
use App\Http\Requests\AddressProfileRequest;
use App\Http\Requests\IdentityProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $data = [
            'title' => 'Profil',
            'user' => $user
        ];

        if($user->role->name === 'Student') {
            return view('main.profile.student.index', compact('data'));
        }
        
        return view('main.profile.mix.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IdentityProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IdentityProfileRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $user->update([
                'name' => $request->name,
            ]);

            if ($request->profile_picture) {
                if (isset($user->user_detail->profile_picture)) {
                    Storage::delete('public/profile-pictures/'.$user->user_detail->profile_picture);
                }

                $profile_picture = md5($request->profile_picture.microtime().'.'.$request->profile_picture->extension());
                Storage::putFileAs(
                    'public/profile-pictures',
                    $request->profile_picture,
                    $profile_picture
                );
            }

            $userDetail = [
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'profile_picture' => $profile_picture ?? $user->user_detail->profile_picture ?? null
            ];
            
            if ($user->user_detail === null) {
                $user->user_detail()->create($userDetail);
            } else {
                $user->user_detail()->update($userDetail);
            }

            if (Auth::user()->role->name !== 'Student') {
                $user->teacher()->update([
                    'education' => $request->education
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->back()->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(AddressProfileRequest $request, User $user)
    {
        try {
            $userAddress = [
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone
            ];

            if ($user->address === null) {
                $user->address()->create($userAddress);
            } else {
                $user->address()->update($userAddress);
            }
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil diubah!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AccountProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(AccountProfileRequest $request, User $user)
    {
        try {
            $user->forceFill([
                'password' => Hash::make($request->password),
            ])->save();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil diubah!']);
    }
}
