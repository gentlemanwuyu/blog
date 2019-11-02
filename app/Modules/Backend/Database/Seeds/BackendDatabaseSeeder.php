<?php
namespace App\Modules\Backend\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BackendDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		 $this->call(CategoriesTableSeeder::class);
		 $this->call(LabelsTableSeeder::class);
		 $this->call(FriendlinksTableSeeder::class);
		 $this->call(SystemConfigsTableSeeder::class);
	}

}
