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
                $image->storeAs('public/images', $imageName);
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
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Make photo_profile optional during update
            'email' => 'nullable|string|email|max:255|unique:clients,email,' . $id, // Ensure unique email but ignore the current client's email
            'address' => 'required|string', // Address should be a string, not numeric
            'password' => 'nullable|string', // Password should be nullable and confirmed for updating
        ]);

        // Only hash the password if it's being updated
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']); // Hash the password
        }

        $imageName = null;

        // Handle image upload if it exists
        if ($request->hasFile('photo_profile')) {
            $image = $request->file('photo_profile');

            // Validate if the image is valid
            if ($image->isValid()) {
                // Generate a unique image name
                $imageName = time() . '.' . $image->extension();

                // Store the image in the storage/public directory
                $image->storeAs('public/images', $imageName);
            } else {
                return back()->with('error', 'Invalid image file.');
            }
        }

        // Only add the image name to the validated data if a new image was uploaded
        if ($imageName) {
            $validated['photo_profile'] = $imageName;
        }

        // Find and update the client record
        try {
            $client = Client::findOrFail($id);
            $client->update($validated);

            return redirect()->route('users.index')->with('success', 'Item berhasil diperbarui!');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update item: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Find the client by ID
            $client = Client::findOrFail($id);

            // Check if the client has a photo and delete it from storage
            if ($client->photo_profile) {
                $imagePath = 'public/images/' . $client->photo_profile;
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
