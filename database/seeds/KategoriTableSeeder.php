<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Kategori;
class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $new = new Kategori;
      $new->id = 1;
      $new->nama_kategori = 'Bedug';
      $new->url_photo = 'storage/kategori/1/bedug1.jpg';
      $new->url_photo = 'storage/kategori/1/bedug2.jpg';
      $new->url_photo = 'storage/kategori/1/bedug3.jpg';
      $new->save();

      $new = new Kategori;
      $new->id = 2;
      $new->nama_kategori = 'Kentongan';
      $new->url_photo = 'storage/kategori/2/kentongan1.jpg';
      $new->url_photo = 'storage/kategori/2/kentongan2.jpg';
      $new->save();

      $new = new Kategori;
      $new->id = 3;
      $new->nama_kategori = 'Penabuh';
      $new->url_photo = 'storage/kategori/3/penabuh1.jpg';
      $new->save();

      $new = new Kategori;
      $new->id = 4;
      $new->nama_kategori = 'Mimbar';
      $new->url_photo = 'storage/kategori/4/mimbar1.jpg';
      $new->url_photo = 'storage/kategori/4/mimbar2.jpg';
      $new->url_photo = 'storage/kategori/4/mimbar3.jpg';
      $new->save();
    }
}
