<?php

function addSeller() {
    $faker = Faker\Factory::create();
    $s = new App\Seller();
    $s->name = $faker->name;
    $s->contact_no = $faker->phoneNumber;
    $s->email = $faker->email;
    $s->save();
    return $s;
}

function addGoods() {
    $faker = Faker\Factory::create();
    $s = new App\Good();
    $s->name = $faker->word;
    $s->details = $faker->sentence;
    $s->save();
    return $s;
}

function addGodown() {
    $faker = Faker\Factory::create();
    $s = new App\Godown();
    $s->name = $faker->company . " Godown";
    $s->location = \App\Coordinates::newCoordinate($faker->latitude,$faker->longitude)->toGeometry();
    $s->address = $faker->address;
    $s->save();
    return $s;
}

function addPurchase() {
    $faker = Faker\Factory::create();
    $s = \App\Purchase::newPurchase();
    $cost = rand(100,10000);
    $seller = \App\Seller::inRandomOrder()->first();
    $s->seller($seller)
        ->date(Carbon::parse($faker->date('Y-m-d')))
        ->due(rand(0,$cost))
        ->cost($cost);
    $godowns = \App\Godown::limit(5)->get()->shuffle();
    $goods = \App\Good::limit(5)->get()->shuffle();
    foreach ($godowns as $godown){
        $good = $goods[rand(0,4)];
        $quantity = rand(1,100);
        $s->addItem($godown,$good,$quantity);
    }
    $s->save();
    return $s;
}

function addSite() {
    $faker = Faker\Factory::create();
    $s = new App\Site();
    $s->name = $faker->company . " Site";
    $s->location = \App\Coordinates::newCoordinate($faker->latitude,$faker->longitude)->toGeometry();
    $s->address = $faker->address;
    $s->save();
    return $s;
}

function addLabour() {
    $faker = Faker\Factory::create();
    $s = new App\Labour();
    $s->name = $faker->name ;
    $s->password = bcrypt('password');
    $s->save();
    return $s;
}

/**
 * @throws Exception
 */
function addTransfer() {
    $godown =  \App\Godown::inRandomOrder()->first();
    $good =  \App\Good::inRandomOrder()->first();
    $site = \App\Site::inRandomOrder()->first();
    $labour = \App\Labour::inRandomOrder()->first();
    $quantity = rand( 0 , $godown->hasGoods($good) );
    $t = \App\SiteTransfer::newTransfer($godown,$good,$site,$labour,$quantity);
    return $t;
}


//$st->updateGoods($godown,$goods,10);
