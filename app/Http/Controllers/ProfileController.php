<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountProfileRequest;
use App\Http\Requests\AddressProfileRequest;
use App\Http\Requests\GuardianProfileRequest;
use App\Http\Requests\IdentityProfileRequest;
use App\Http\Requests\ParentsProfileRequest;
use Illuminate\Http\Request;
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

        if($user->role->name === 'Student') {
            $fatherIdentity = $user->student->families()->where('type', 'Father')->first();
            $fatherAddress = $fatherIdentity ? $fatherIdentity->address()->first() : null;
            $motherIdentity = $user->student->families()->where('type', 'Mother')->first();
            $guardianIdentity = $user->student->families()->where('type', 'Guardian')->first();
            $guardianAddress = $guardianIdentity ? $guardianIdentity->address()->first() : null;
            $father = [
                'name' => $fatherIdentity->name ?? '',
                'occupation' => $fatherIdentity->occupation ?? '',
                'address' => $fatherAddress->address ?? '',
                'phone' => $fatherAddress->phone ?? ''
            ];
            $mother = [
                'name' => $motherIdentity->name ?? '',
                'occupation' => $motherIdentity->occupation ?? ''
            ];
            $guardian = [
                'name' => $guardianIdentity->name ?? '',
                'occupation' => $guardianIdentity->occupation ?? '',
                'address' => $guardianAddress->address ?? '',
                'phone' => $guardianAddress->phone ?? ''
            ];
            $data= [
                'title' => 'Profil',
                'user' => $user,
                'father' => $father,
                'mother' => $mother,
                'guardian' => $guardian
            ];

            return view('main.profile.student.index', compact('data'));
        } else {
            $data= [
                'title' => 'Profil',
                'user' => $user
            ];

            return view('main.profile.mix.index', compact('data'));
        }
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
     * @param  \App\Http\Requests\ParentsProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateParents(ParentsProfileRequest $request, User $user)
    {
        $father = $user->student->families()->where('type', 'Father')->first();
        $mother = $user->student->families()->where('type', 'Mother')->first();

        try {
            DB::beginTransaction();
            
            $userFather = [
                'type' => $request->father['type'],
                'name' => $request->father['name'],
                'occupation' => $request->father['occupation']
            ];

            $userMother = [
                'type' => $request->mother['type'],
                'name' => $request->mother['name'],
                'occupation' => $request->mother['occupation']
            ];

            $fatherAddress = [
                'address' => $request->father['address'],
                'phone' => $request->father['phone']
            ];

            if (!$father) {
                $fatherCreated = $user->student->families()->create($userFather);
                $fatherCreated->address()->create($fatherAddress);
            } else {
                $father->update($userFather);
                $father->address()->update($fatherAddress);
            }

            if (!$mother) {
                $user->student->families()->create($userMother);
            } else {
                $mother->update($userMother);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil diubah!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GuardianProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGuardian(GuardianProfileRequest $request, User $user)
    {
        $guardian = $user->student->families()->where('type', 'Guardian')->first();

        try {
            DB::beginTransaction();
            
            $userGuardian = [
                'type' => $request->guardian['type'],
                'name' => $request->guardian['name'],
                'occupation' => $request->guardian['occupation']
            ];
            $guardianAddress = [
                'address' => $request->guardian['address'],
                'phone' => $request->guardian['phone']
            ];

            if (!$guardian) {
                $guardianCreated = $user->student->families()->create($userGuardian);
                $guardianCreated->address()->create($guardianAddress);
            } else {
                $guardian->update($userGuardian);
                $guardian->address()->update($guardianAddress);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

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
                'password' => Hash::make($request->new_password),
            ])->save();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil diubah!']);
    }
}
