<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());

        $imagen = $request->file('file');

        // Generate a unique ID for the image
        $nombreImagen = Str::uuid() . ".png"; // Change the extension to PNG

        // Read the image
        $imagenServidor = $manager->read($imagen);

        // Scale the image
        $imagenServidor->scale(800, 800);

        // Save the image to the server in PNG format
        $imagenesPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenesPath, 'png');

        // Return the name of the image
        return response()->json(['imagen' => $nombreImagen]);
    }
}