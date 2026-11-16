<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk mencegah XSS & Malicious Input
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Sanitasi input menggunakan strip_tags()
        Service::create([
            'name' => strip_tags($validated['name']),
            'price' => $validated['price'],
            'description' => strip_tags($validated['description'] ?? ''),
        ]);

        return redirect()->back()->with('success', 'Jasa servis berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $service->update([
            'name' => strip_tags($validated['name']),
            'price' => $validated['price'],
            'description' => strip_tags($validated['description'] ?? ''),
        ]);

        return redirect()->back()->with('success', 'Data jasa servis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'Jasa servis berhasil dihapus!');
    }
}