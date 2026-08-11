<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'T-Shirt Leet Classic',
            'kategori' => 'T-Shirt',
            'deskripsi' => 'Kaos berkualitas tinggi dengan desain klasik dari Leet.',
            'gambar0' => 'default.png',
            'gambar1' => 'default.png',
            'gambar2' => 'default.png',
            'gambar3' => 'default.png',
            'stokS' => 10,
            'stokM' => 20,
            'stokL' => 30,
            'stokXL' => 15,
            'stok2XL' => 5,
            'harga' => 150000,
        ]);

        Produk::create([
            'nama_produk' => 'Hoodie Leet Essential',
            'kategori' => 'Hoodie',
            'deskripsi' => 'Hoodie nyaman dan hangat untuk sehari-hari.',
            'gambar0' => 'default.png',
            'gambar1' => 'default.png',
            'gambar2' => 'default.png',
            'gambar3' => 'default.png',
            'stokS' => 5,
            'stokM' => 10,
            'stokL' => 15,
            'stokXL' => 10,
            'stok2XL' => 5,
            'harga' => 350000,
        ]);
        
        Produk::create([
            'nama_produk' => 'Jacket Leet Premium',
            'kategori' => 'Jacket',
            'deskripsi' => 'Jaket premium anti air dan angin untuk berbagai cuaca.',
            'gambar0' => 'default.png',
            'gambar1' => 'default.png',
            'gambar2' => 'default.png',
            'gambar3' => 'default.png',
            'stokS' => 8,
            'stokM' => 15,
            'stokL' => 20,
            'stokXL' => 12,
            'stok2XL' => 3,
            'harga' => 450000,
        ]);
    }
}
