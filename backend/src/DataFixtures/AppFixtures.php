<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Posts;
use \Datetime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $entityManager): void
    {
        $dateTimeNow = new DateTime('now');

        $posts = new Posts();
        $posts->setText('qwrwetqw');
        $posts->setDatetime($dateTimeNow);
        $entityManager->persist($posts);

        $posts = new Posts();
        $posts->setText('152365346745');
        $posts->setDatetime($dateTimeNow);
        $entityManager->persist($posts);

        $entityManager->flush();
    }
}
