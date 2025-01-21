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
            $request->photo_item->storeAs('images/', $imagedName);
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
            'photo_item' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Buat photo_item tidak wajib
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $item = Item::findOrFail($id);

        // Hapus gambar lama jika ada file baru diupload
        if ($request->hasFile('photo_item')) {
            // Hapus gambar lama jika exists
            if ($item->photo_item) {
                Storage::disk('public')->delete('images/' . $item->photo_item);
            }

            // Upload gambar baru
            $imagedName = time() . '.' . $request->file('photo_item')->extension();
            $request->photo_item->storeAs('images/', $imagedName);
            $validated['photo_item'] = $imagedName;
        }


        // Update item
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

            // Hapus gambar jika ada
            if ($item->photo_item) {
                try {
                    $imagePath = 'images/' . $item->photo_item;
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                } catch (Exception $imageError) {
                    // Log error penghapusan gambar
                    $imageError->getMessage();
                }
            }

            // Hapus item dari database
            $item->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus!');

        } catch (Exception $error) {
            // Log error
            $error->getMessage();

            // Redirect dengan pesan error
            return redirect()->route('items.index')->with('error', 'Gagal menghapus item: ' . $error->getMessage());
        }
    }
}
