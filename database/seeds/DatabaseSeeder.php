<?php

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        if($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data?')){
			// Call the php artisan migrate:refresh
			
			$this->command->call('migrate:refresh');
			
			$this->command->warn('Data cleared, starting from blank database.');
		}
		//Seed the default permissions
		$permissions = Permission::defaultPermissions();
		
		foreach($permissions as $perms){
			Permission::firstOrCreate(['name'=> $perms]);	
		}
		
		$this->command->info('Default Permissions added.');
		
		//confirm roles needed
		if($this->command->confirm('Create Roles for users, default is admin and user?[Y|N]',true)){
			// Ask for roles from input 
			$input_roles = $this->command->ask('enter roles in comma separate format.','Admin,User');
			
			//Explode roles
			
			$roles_array = explode(',',$input_roles);
			
			//add roles
			
			foreach($roles_array as $role){
				$role = Role::firstOrCreate(['name'=> trim($role)]);
				
				if($role->name =='Admin'){
					// assign all permissions
					$role->syncPermissions(Permission::all());
					$this->command->info('Admin granted all the permission');
				}else{
					// for ohers by default only read access
					$role->syncPermissions(Permission::where('name','LIKE','view_%')->get());
				}
				
				//create one user for each role
				
				$this->createUser($role);
			}
			
			$this->command->info('Roles'.$input_roles.'added successfully');
		}else{
			Role::firstOrCreate(['name'=>'User']);
			$this->command->info('Added only default user role.');
		}
		
		// now lets seed some post for demo
		
		//factory(\App\Post::class, 30)->create();
		
		//$this->command->info('Some Posts data seeded.');
		
		//$this->command->warn('All done :)');
    }
    /**
    * 
	*Create a user with given role
	*@param $role
	* 
	* */
	
	private function createUser($role){
		$user = factory(user::class)->create();
		
		$user->assignRole($role->name);
		
		if($role->name =='Admin'){
			$this->command->info('Here is your admin details to login:');
			
			$this->command->warn($user->email);
			
			$this->command->warn('Password is "secret"');
		}
		
	}
}
