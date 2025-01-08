<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Connection;
use App\Models\Avatar;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('id', '!=', Auth::id())
            ->when($query, function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('profession', 'LIKE', '%' . $query . '%')
                    ->orWhere('skill', 'LIKE', '%' . $query . '%')
                    ->orWhereJsonContains('field', $query);
            })->get();

        return view('homepage', compact('users', 'query'));
    }

    public function filter(Request $request)
    {
        $query = User::query()->where('id', '!=', Auth::id());

        // Filter berdasarkan gender
        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        // Filter berdasarkan field
        if ($request->has('field') && !empty($request->field)) {
            $query->whereJsonContains('field', $request->field);
        }

        $users = $query->get();

        // Daftar lengkap field untuk dropdown
        $fields = [
            'Information Technology', 'Healthcare', 'Education', 'Finance', 'Marketing',
            'Engineering', 'Construction', 'Hospitality', 'Retail', 'Manufacturing',
            'Transportation', 'Logistics', 'Real Estate', 'Legal Services', 'Media and Entertainment'
        ];

        return view('homepage', compact('users', 'fields'));
    }

    public function profile()
    {
        $user = Auth::user();
        $connection = Connection::where('user_id', Auth::id())
                                ->where('status', 'connected')
                                ->get();
        $avatar = Avatar::whereIn('id', $user->avatars->pluck('id'))->get();
        return view('profile', compact('user', 'connection', 'avatar'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'gender' => ['required', 'in:male,female'],
            'phone' => ['required', 'regex:/^[0-9]{8,15}$/'],
            'linkedin' => ['required', 'regex:/^https:\/\/www\.linkedin\.com\/in\/[a-zA-Z0-9-]+$/'],
            'field' => ['required', 'array', 'min:3'],
            'field.*' => ['string'],
            'profession' => ['required', 'string'],
            'skill' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $image = $request->file('image');
                $imageContents = file_get_contents($image->getPathname());
                if ($imageContents !== false) {
                    $user->image = $imageContents;
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->linkedin = $request->linkedin;
        $user->field = $request->field;
        $user->profession = $request->profession;
        $user->skill = $request->skill;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}
