<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create($fakerLocale = 'fr_FR');

$categories= [
    'Roman',
    'Bande dessiné',
    'Poésie',
    'Fantastique',
    'Documentaire',
    'Policier',
    'Aventure',
    'Biographique',
];


$objectCategory=[];

for ($i=0; $i < count($categories) ; $i++) {

$category = new Category;
$category->setName($categories[$i])
    ->setDescription($faker->sentence(1))
    ->setImage($faker->image())
    ;
    array_push($objectCategory, $category);
$manager->persist($category);
}

 
        for ($i=0; $i < 500 ;$i++) {

            $book = new Book();
            $book->setTitle($faker->sentence(1))
                -> setDescription ($faker->sentence(7))
                -> setSLug('slug-temporaire')
                -> setPages ($faker->numberBetween(57,319))
                -> setYear ($faker->numberBetween(1903,2023))
                -> setIsAvailable($faker->boolean())
                -> setCategory ($objectCategory[rand(0,7)])
            ;
         $manager->persist($book);
        }

    $manager->flush();
    
}
}
