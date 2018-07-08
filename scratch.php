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
    $seller = \App\Seller::inRandomOrder()->first();
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
    $st = \App\SiteTransfer::newTransfer($godown,$good,$site,$labour,$quantity);
    if($st){
        $qty = $quantity > 1 ? $quantity/2 : $quantity;
        $st->addActivity(0,\App\Status::GODOWN());
        $st->addActivity($qty,\App\Status::SITE());
        $st->addActivity(0,\App\Status::GODOWN());
        $st->addActivity($qty,\App\Status::SITE());
    }
    return $st;
}


//$st->updateGoods($godown,$goods,10);
