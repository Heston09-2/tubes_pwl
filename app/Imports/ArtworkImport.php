<?php

namespace App\Imports;

use App\Models\Artwork;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArtworkImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Nama folder tempat gambar disimpan
        $imagePath = $row['image'];

        
        // Cek apakah gambar ada di folder public/storage/images
        if (!Storage::disk('public')->exists('images/' . $imagePath)) {
            // Jika gambar tidak ada, gunakan gambar default
            $imagePath = 'default.jpg';
        }
        

        return new Artwork([
            'name' => $row['name'],
            'category' => $row['category'],
            'creator' => $row['creator'],
            'year' => $row['year'],
            'origin' => $row['origin'],
            'description' => $row['description'],
            'image' => $imagePath,
            'views' => 0, // Inisialisasi views dengan 0
            'status' => 'pending', // Status awal adalah pending
        ]);
    }
}
