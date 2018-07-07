<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class IgniteTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $this->BasicSeeder($faker);
        $this->PurchaseSeeder($faker);
        $this->TransferSeeder($faker);
    }

    public function BasicSeeder($faker)
    {
        for($i = 0; $i < 10; $i++) {
            $s = new App\Seller();
            $s->name = $faker->name;
            $s->contact_no = $faker->phoneNumber;
            $s->email = $faker->email;
            $s->save();
        }

        for($i = 0; $i < 10; $i++) {
            $s = new App\Good();
            $s->name = $faker->word;
            $s->details = $faker->sentence;
            $s->save();
        }

        for($i = 0; $i < 10; $i++) {
            $s = new App\Godown();
            $s->name = $faker->company . " Godown";
            $s->location = \App\Coordinates::newCoordinate($faker->latitude,$faker->longitude)->toGeometry();
            $s->address = $faker->address;
            $s->save();
        }

        for($i = 0; $i < 10; $i++) {
            $s = new App\Site();
            $s->name = $faker->company . " Site";
            $s->location = \App\Coordinates::newCoordinate($faker->latitude,$faker->longitude)->toGeometry();
            $s->address = $faker->address;
            $s->save();
        }

        for($i = 0; $i < 10; $i++) {
            $s = new App\Labour();
            $s->name = $faker->name ;
            $s->password = bcrypt('password');
            $s->save();
        }

    }


    public function PurchaseSeeder($faker)
    {
        $sellers = \App\Seller::limit(10)->get()->shuffle();
        foreach ($sellers as $seller) {
            $s = \App\Purchase::newPurchase()
                ->seller($seller)
                ->date(Carbon::parse($faker->date('Y-m-d')))
                ->due(rand(0,500));
            $godowns = \App\Godown::limit(5)->get()->shuffle();
            $goods = \App\Good::limit(5)->get()->shuffle();
            foreach ($godowns as $godown){
                $good = $goods[rand(0,4)];
                $quantity = rand(1,100);
                $cost = rand(100,3000);
                $s->addItem($godown,$good,$quantity,$cost);
            }
            $s->save();
        }
    }

    /**
     * @param $faker
     * @throws Exception
     */
    public function TransferSeeder($faker)
    {
        $n = 10;
        $goods = \App\Good::limit($n)->get()->shuffle();
        $godowns = \App\Godown::limit($n)->get()->shuffle();
        $sites = \App\Site::limit($n)->get()->shuffle();
        $labours = \App\Labour::limit($n)->get()->shuffle();
        for($i = 0; $i < $n; $i++) {
            $godown = $godowns[$i];
            $good = $goods[$i];
            $site = $sites[$i];
            $labour = $labours[$i];
            $quantity = rand( 0 , $godown->hasGoods($good) );
            \App\SiteTransfer::newTransfer($godown,$good,$site,$labour,$quantity);
        }
    }
}
