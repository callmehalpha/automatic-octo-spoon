<?php

namespace Modules\Core\Database\Seeders;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Investments\Entities\Investment;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class StartupSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        /*$perms = ['add', 'view', 'edit', 'delete'];
        $roles = ['user', 'admin', 'superAdmin'];
        $modules = ['investment', 'user', 'payment'];*/


        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'edit setting']);
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'edit payment']);
        Permission::create(['name' => 'add payment']);
        Permission::create(['name' => 'view payment']);
        Permission::create(['name' => 'delete payment']);

        Permission::create(['name' => 'edit investment']);
        Permission::create(['name' => 'add investment']);
        Permission::create(['name' => 'view investment']);
        Permission::create(['name' => 'delete investment']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('edit payment');
        $role1->givePermissionTo('view payment');
        $role1->givePermissionTo('add payment');
        $role1->givePermissionTo('delete payment');

        $role1->givePermissionTo('edit user');
        $role1->givePermissionTo('view user');
        $role1->givePermissionTo('add user');
        $role1->givePermissionTo('delete user');

        $role1->givePermissionTo('edit investment');
        $role1->givePermissionTo('edit setting');
        $role1->givePermissionTo('view investment');
        $role1->givePermissionTo('add investment');
        $role1->givePermissionTo('delete investment');

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo('view payment');
        $role2->givePermissionTo('add payment');
        $role2->givePermissionTo('edit user');
        $role2->givePermissionTo('view investment');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role3->givePermissionTo('edit payment');
        $role3->givePermissionTo('edit setting');
        $role3->givePermissionTo('view payment');
        $role3->givePermissionTo('add payment');
        $role3->givePermissionTo('delete payment');

        $role3->givePermissionTo('edit user');
        $role3->givePermissionTo('view user');
        $role3->givePermissionTo('add user');
        $role3->givePermissionTo('delete user');

        $role3->givePermissionTo('edit investment');
        $role3->givePermissionTo('view investment');
        $role3->givePermissionTo('add investment');
        $role3->givePermissionTo('delete investment');
        // create demo users
        $user = User::create([
            'email' => 'test@example.com',
            'firstname' => 'Example',
            'lastname' => 'User',
            'cryptocurrency' => 'btc',
            'wallet_address' => 'qwerty123654mnbvcxzaqsdrlkjhgfrt',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role2);

        $user = User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'cryptocurrency' => 'btc',
            'wallet_address' => 'qwerty123654mnbvcxzaqsdrlkjhgfrt',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'cryptocurrency' => 'btc',
            'wallet_address' => 'qwerty123654mnbvcxzaqsdrlkjhgfrt',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole($role3);

        /**
         * Investment seed runner
         */
        Investment::create(
            [
           'name' => 'Testing',
           'daysOfMining' => 1,
           'startDate' => '2021-04-28',
            'rate' => 5,
            'price' => 1000,
                'info' => 'Testing Info'
        ],
            [
                'name' => 'Testing1',
                'daysOfMining' => 1,
                'startDate' => '2021-04-28',
                'rate' => 50,
                'price' => 15550,
                'info' => 'Testing Info'
            ]
        );

        DB::table('settings')
            ->insert(
                [
                    'id' => 1,
                    'bitcoinWalletAddress'=> 'qwertyqwertyqwertyqwertyqwertyqwerty',
                    'litecoinWalletAddress'=> 'qwertyqwertyqwertyqwertyqwertyqwerty',
                    'ethereumWalletAddress'=> 'qwertyqwertyqwertyqwertyqwertyqwerty',
                ]
            );
    }


}
