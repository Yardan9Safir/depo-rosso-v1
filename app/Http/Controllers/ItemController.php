<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::paginate(4);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_item' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $imagedName = null;

        if ($request->photo_item) {
            $imagedName = time() . '.' . $request->file('photo_item')->extension();
            $request->photo_item->storeAs('public/images/', $imagedName);
        }

        // Add the image name to the validated data before creating the item
        $validated['photo_item'] = $imagedName;

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_item' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $imagedName = null;

        if ($request->hasFile('photo_item')) {
            $imagedName = time() . '.' . $request->file('photo_item')->extension();
            $request->photo_item->storeAs('public/images', $imagedName);  // Removed the trailing slash from the directory name
        }

        // Only include the image name if a new image was uploaded
        if ($imagedName) {
            $validated['photo_item'] = $imagedName;
        }

        $item = Item::findOrFail($id);
        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui!');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the item by ID
            $item = Item::findOrFail($id);

            // Check if the item has an image and delete it from storage
            if ($item->image) {
                $imagePath = 'public/images/' . $item->image;
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath); // Delete the image file
                }
            }

            // Delete the item record
            $item->delete();

            // Redirect back with success message
            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus!');
        } catch (Exception $error) {
            // Return the error message if an exception occurs
            return $error->getMessage();
        }
    }
}
