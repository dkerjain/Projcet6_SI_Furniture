<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $new = new User();
      $new->name = 'Annisa PK';
      $new->email = 'Annisa@gmail.com';
      $new->password = bcrypt('123');
      $new->save();

      $new = new User();
      $new->name = 'Bayu RS';
      $new->email = 'Bayu@gmail.com';
      $new->password = bcrypt('123');
      $new->save();
    }
}
