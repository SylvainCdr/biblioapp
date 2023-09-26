<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Editor;
use App\Entity\Format;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Language;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // On instancie Faker pour générer des données aléatoires en français
        $faker = Factory::create($fakerLocale = 'fr_FR');

        /**
         * Les catégories
         * Traitement pour l'ajout des catégories
         */
        $categories = [
            'Roman',
            'Bande dessiné',
            'Poésie',
            'Fantastique',
            'Documentaire',
            'Policier',
            'Aventure',
            'Biographie',
        ];
        // Les ojects catégories instanciés
        $objectCategory = [];
        // On boucle sur les catégories
        for ($i = 0; $i < count($categories); $i++) {
            $category = new Category;
            $category->setName($categories[$i])
                ->setDescription($faker->sentence(1))
                ->setImage($faker->image());
            // On ajoute l'objet catégorie dans le tableau
            array_push($objectCategory, $category);
            // On persiste l'objet catégorie
            $manager->persist($category);
        }

        /**
         * Les auteurs
         * Traitement pour l'ajout des auteurs
         */
        $objectAuthor = [];
        // Les auteurs
        for ($i = 0; $i < 100; $i++) {
            $author = new Author();
            $author->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setBio($faker->sentence(1))
                ->setLink($faker->url());
            // On ajout l'objet auteur dans le tableau
            array_push($objectAuthor, $author);
            // On persiste l'objet auteur
            $manager->persist($author);
        }

        /**
         * Les éditeurs
         * Traitement pour l'ajout des éditeurs
         */
        $editors = [
            'Gallimard',
            'Hachette',
            'Larousse',
            'Nathan',
            'Hatier',
            'Flammarion',
            'Dunod',
            'Livre de poche',
        ];
        // Les objects éditeurs instanciés
        $objectEditor = [];
        // On boucle sur les éditeurs
        for ($i = 0; $i < count($editors); $i++) {
            $editor = new Editor();
            $editor->setName($editors[$i])
                ->setYear($faker->numberBetween(1950, 2023));
            // On ajoute l'objet éditeur dans le tableau
            array_push($objectEditor, $editor);
            // On persiste l'objet éditeur
            $manager->persist($editor);
        }

        /**
         * Les formats
         * Traitement pour l'ajout des formats
         */
        $formats = [
            'Poche',
            'Broché',
            'Relié',
        ];

        // Les objects formats instanciés
        $objectFormat = [];
        // On boucle sur les formats
        for ($i = 0; $i < count($formats); $i++) {
            $format = new Format();
            $format->setName($formats[$i]);
            // On ajoute l'objet format dans le tableau
            array_push($objectFormat, $format);
            // On persiste l'objet format
            $manager->persist($format);
        }

        /**
         * Les langues
         * Traitement pour l'ajout des langues
         */
        $languages = [
            [
                'Français',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/1200px-Flag_of_France.svg.png'
            ],
            [
                'Anglais',
                'data:image/png;base64,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'
            ],
            [
                'Espagnol',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Flag_of_Spain.svg/1200px-Flag_of_Spain.svg.png'
            ],
            [
                'Allemand',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Flag_of_Germany.svg/1200px-Flag_of_Germany.svg.png'
            ],
            [
                'Italien',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Flag_of_Italy.svg/1200px-Flag_of_Italy.svg.png'
            ],
            [
                'Portugais',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Flag_of_Portugal.svg/1200px-Flag_of_Portugal.svg.png'
            ],
            [
                'Russe',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Flag_of_Russia.svg/1200px-Flag_of_Russia.svg.png'
            ],
            [
                'Chinois',
                'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/1200px-Flag_of_the_People%27s_Republic_of_China.svg.png'
            ],
        ];
        // Les objects langues instanciés
        $objectLanguage = [];
        // On boucle sur les langues
        for ($i = 0; $i < count($languages); $i++) {
            $language = new Language();
            $language->setName($languages[$i][0])
                ->setFlag($languages[$i][1]);
            // On ajoute l'objet langue dans le tableau
            array_push($objectLanguage, $language);
            // On persiste l'objet langue
            $manager->persist($language);
        }

        /**
         * Les livres
         * Traitement pour l'ajout des livres
         */
        for ($i = 0; $i < 200; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(2)) // 2 mots
                ->setDescription($faker->sentence(10)) // 7 mots
                ->setSlug($faker->slug()) // Ajout d'un slug aléatoire
                ->setPages($faker->numberBetween(50, 500)) // 50 à 500
                ->setYear($faker->numberBetween(1950, 2023)) // 1950 à 2023
                ->setCategory($objectCategory[rand(0, 7)]) // Ajout d'une catégorie aléatoire
                ->addAuthor($objectAuthor[rand(0, 99)]) // Ajout d'un auteur aléatoire
                ->setEditor($objectEditor[rand(0, 7)]) // Ajout d'un éditeur aléatoire
                ->setFormat($objectFormat[rand(0, 2)]) // Ajout d'un format aléatoire
                ->setLanguage($objectLanguage[rand(0, 7)]) // Ajout d'une langue aléatoire
                ->setCover($faker->image()) // Ajout d'une image aléatoire
                ->setPrice($faker->randomFloat(2, 5, 30)) // Prix entre 5 et 30 avec 2 chiffres après la virgule
                ->setIsbn($faker->isbn13()) // Ajout d'un isbn aléatoire
                ->setIsAvailable($faker->boolean()) // Ajout d'un booléen aléatoire
            ;

            // On ajoute 40 clients aléatoirement qui ont emprunté le livre
            if ($i < 40) {
                $client = new Client();
                $client->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setEmail($faker->email())
                    ->setPostalCode(95130)
                    ->setCity('Franconville')
                    ->setYear($faker->numberBetween(1950, 2023))
                    ->addBook($book)
                    ->setDeposit($faker->boolean());
                // On persiste l'objet client
                $manager->persist($client);
            }
            // On persiste l'objet livre
            $manager->persist($book);
        }

        // On envoie les données en BDD
        $manager->flush();
    }
}