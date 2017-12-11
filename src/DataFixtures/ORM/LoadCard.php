<?php

namespace App\DataFixtures\ORM;

use App\Entity\Card;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCard extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        $card = new Card();
        $card->setName('Aile de mort');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Cénarius');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Chante-esprit');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Chroniqueur Cho');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Serpent de la fosse');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Monstre du chaos');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Tigre de Sibérie');
        $manager->persist($card);

        $manager->flush();
    }
}
