<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $users = Client::paginate(4);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255|unique:clients,email',
            'address' => 'required|string',
            'password' => 'required|string', // Ensure password confirmation is handled
        ]);

        // Hash the password
        $validated['password'] = bcrypt($validated['password']);

        // Default image name
        $imageName = null;

        // Handle image upload if it exists
        if ($request->hasFile('photo_profile')) {
            $image = $request->file('photo_profile');

            // Validate if the image is valid
            if ($image->isValid()) {
                // Generate a unique image name
                $imageName = time() . '.' . $image->extension();

                // Store the image in the storage/public directory
                $image->storeAs('images/', $imageName);
            } else {
                return back()->with('error', 'Invalid image file.');
            }
        }

        // Add the image name to the validated data if there is an image
        $validated['photo_profile'] = $imageName;

        // Create the client record
        try {
            Client::create($validated);
            return redirect()->route('users.index')->with('success', 'Item berhasil ditambahkan!');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to add item: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(Client $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar opsional
            'email' => 'nullable|string|email|max:255|unique:clients,email,' . $id, // Email harus unik kecuali milik klien saat ini
            'address' => 'required|string', // Alamat harus berupa string
            'password' => 'nullable|string', // Password opsional dan hanya diupdate jika diisi
        ]);

        // Hash password jika diisi
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // Cari klien berdasarkan ID
        $client = Client::findOrFail($id);

        // Tangani pengunggahan gambar jika ada
        if ($request->hasFile('photo_profile')) {
            // Hapus gambar lama jika ada
            if ($client->photo_profile) {
                Storage::disk('public')->delete('images/' . $client->photo_profile);
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->file('photo_profile')->extension();
            $request->file('photo_profile')->storeAs('images', $imageName, 'public');
            $validated['photo_profile'] = $imageName;
        }

        // Perbarui data klien
        try {
            $client->update($validated);

            return redirect()->route('users.index')->with('success', 'Item berhasil diperbarui!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui item: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            // Find the client by ID
            $client = Client::findOrFail($id);

            // Check if the client has a photo and delete it from storage
            if ($client->photo_profile) {
                $imagePath = 'images/' . $client->photo_profile;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath); // Delete the image file
                }
            }

            // Delete the client record
            $client->delete();

            // Redirect back with success message
            return redirect()->route('users.index')->with('success', 'Item berhasil dihapus!');
        } catch (Exception $error) {
            // Return the error message if an exception occurs
            return $error->getMessage();
        }
    }

}
