<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'allUsers' => User::role('user')
                            ->paginate(10)
        ];
        return view('dashboard.user.index', $data);
    }

    public function addUser()
    {
        return view('dashboard.user.add');
    }

    public function createUser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            $user->assignRole('user');
            return redirect()->route('dashboard.user.index')->with('flash', [
                'card' => 'success',
                'message' => 'Data Pengguna berhasil dibuat'
            ]);
        }else{
            return redirect()->route('dashboard.user.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Data Pengguna gagal dibuat'
            ]);
        }
    }

    public function editUser($id)
    {
        $data = [
            'userData' => User::find($id)
        ];
        return view('dashboard.user.edit', $data);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if(empty($user)){
            return redirect()->route('dashboard.user.index')->with('flash', [
                'card' => 'warning',
                'message' => 'Data Pengguna tidak ditemukan'
            ]);
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if($user->save()){
                return redirect()->route('dashboard.user.index')->with('flash', [
                    'card' => 'success',
                    'message' => 'Data Pengguna berhasil diubah'
                ]);
            }else{
                return redirect()->route('dashboard.user.index')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Data Pengguna gagal diubah'
                ]);
            }
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if($user->delete()){
            return redirect()->route('dashboard.user.index')->with('flash', [
                'card' => 'success',
                'message' => 'Data Pengguna berhasil dihapus'
            ]);
        }else{
            return redirect()->route('dashboard.user.index')->with('flash', [
                'card' => 'failed',
                'message' => 'Data Pengguna gagal dihapus'
            ]);
        }
    }
}
