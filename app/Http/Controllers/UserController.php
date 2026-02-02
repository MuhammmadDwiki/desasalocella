<?php

namespace App\Http\Controllers;

use App\Models\RT;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=','super_admin')
                        ->leftJoin("r_t_s", 'users.id_rt','r_t_s.id_rt')
                        ->select(
                            'r_t_s.id_rt',
                            'r_t_s.nomor_rt',
                            'users.*'
                        )
                        ->get();
        $rt = RT::all();
        return Inertia::render('Akun', [
            'users' => $users,
            'rt' => $rt
        ]);
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:'.User::class,
            'email' => [
                'required',
                'string',
                'lowercase',
                'max:255',
                'unique:'.User::class,
                (new Email())
                    ->validateMxRecord()
                    ->rfcCompliant()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_rt'=> 'required|string|exists:r_t_s,id_rt',
            'last_password_change' => now()
            ]);
            
        $validated['email_verified_at'] = null;
        $validated['email_verification_required'] = true;
        // dd($validated);

        $user = User::create($validated);
        
        event(new Registered($user));

        return redirect()->back()->with('success','User berhasil dibuat. Email verifikasi telah dikirim ke ' . $user->email);

    }
    public function show($id)
    {

    }
    public function edit($id)
    {
    }
    public function update(Request $request, User $user)
    {
        // dd($user);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email,'.$user->id
            ],
            'password' => 'sometimes|nullable|confirmed|min:8',
            'id_rt' => 'required|string|exists:r_t_s,id_rt'
        ]);

        // Hapus password dari array jika kosong
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function ubahProfileInformation(Request $request, User $user)
    {
        # TODO: fix logic because gk mau ke update data nya
        // dd($user);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        ]);

        $user->update($validated);       

        return redirect()->back()->with('success', 'berhasil');
    }

    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data user berhasil dihapus');

    }
}
