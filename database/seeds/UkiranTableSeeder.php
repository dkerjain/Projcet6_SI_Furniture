<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Ukiran;
class UkiranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
      $new = new Ukiran;
      $new->id = 1;
      $new->nama_ukiran = 'None';
      $new->url_photo = 'storage/ukiran/1/bedug1.jpg';
      $new->save();

      $new = new Ukiran;
      $new->id = 2;
      $new->nama_ukiran = 'Bunga';
      $new->url_photo = 'storage/ukiran/2/bedug1.jpg';
      $new->save();

      $new = new Ukiran;
      $new->id = 3;
      $new->nama_ukiran = 'Kaligrafi';
      $new->url_photo = 'storage/ukiran/3/bedug1.jpg';
      $new->save();
    }
}
