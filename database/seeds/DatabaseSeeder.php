<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	App\User::truncate();
    	App\Company::truncate();
    	App\House::truncate();
    	App\Employee::truncate();
    	App\Shift::truncate();

        $user = factory(App\User::class)->create();
        $company = factory(App\Company::class)->create(['user_id'=>$user->id]);
        $user->update(['company_id'=>$company->id]);
        $houses = factory(App\House::class,4)->create(['company_id'=>$company->id]);
        $randomNumberOfEmployee = rand(20,30);
        foreach($houses as $house){
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'','start'=>'0','end'=>'0','duration'=>0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'E','start'=>'8:00','end'=>'15:00','duration'=>7.0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'L','start'=>'15:00','end'=>'22:00','duration'=>7.0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'D','start'=>'8:00','end'=>'22:00','duration'=>14.0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'N','start'=>'22:00','end'=>'08:00','duration'=>10.0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'A','start'=>'00:00','end'=>'00:00','duration'=>0.0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'O','start'=>'00:00','end'=>'00:00','duration'=>0.0]);
        	factory(App\Shift::class)->create(['house_id'=>$house->id,'name'=>'S','start'=>'00:00','end'=>'00:00','duration'=>0.0]);

        	factory(App\Employee::class,$randomNumberOfEmployee)->create(['house_id'=>$house->id,'position'=>'support worker']);
        	factory(App\Employee::class,intval($randomNumberOfEmployee/5))->create(['house_id'=>$house->id,'position'=>'team leader']);
        	$deputy = factory(App\Employee::class)->create(['house_id'=>$house->id,'position'=>'deputy manager']);
        		factory(App\User::class)->create([
        			'house_id'=>$house->id,
        			'name'=>$deputy->name,
        			'house_slug'=>str_slug($house->name),
        			'company_id'=>$house->company_id,
        			'admin'=>0,
        			'email'=>$deputy->email,
        			'password'=>Hash::make('secret'),
        			'remember_token' => str_random(10),
        		]);
        	$manager = factory(App\Employee::class)->create(['house_id'=>$house->id,'position'=>'manager']);
        		factory(App\User::class)->create([
        			'house_id'=>$house->id,
        			'name'=>$manager->name,
        			'house_slug'=>str_slug($house->name),
        			'company_id'=>$house->company_id,
        			'admin'=>0,
        			'email'=>$manager->email,
        			'password'=>Hash::make('secret'),
        			'remember_token' => str_random(10),
        		]);
        	$administrator = factory(App\Employee::class)->create(['house_id'=>$house->id,'position'=>'administrator']);
        		factory(App\User::class)->create([
        			'house_id'=>$house->id,
        			'name'=>$administrator->name,
        			'house_slug'=>str_slug($house->name),
        			'company_id'=>$house->company_id,
        			'admin'=>0,
        			'email'=>$administrator->email,
        			'password'=>Hash::make('secret'),
        			'remember_token' => str_random(10),
        		]);
        	factory(App\Employee::class)->create(['house_id'=>$house->id,'position'=>'handyman']);
        	factory(App\Employee::class)->create(['house_id'=>$house->id,'position'=>'cleaner']);
        	factory(App\Employee::class)->create(['house_id'=>$house->id,'position'=>'cook']);
        }
    }
}
