<?php
declare(strict_types = 1);

namespace App\DataFixtures;

use App\Entity\AdvertisementEntity;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class Advertisement extends Fixture implements DependentFixtureInterface
{
    /**
     * Loader
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {
            $this->createUser($i, $manager);

            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            User::class,
        );
    }

    /**
     * @param $i
     * @param ObjectManager $manager
     * @return UserModel
     */
    private function createUser($i, ObjectManager $manager)
    {
        $user = $this->getReference('user_' . $i);

        $advertisement = new AdvertisementEntity();
        $advertisement->setName('Foo');
        $advertisement->setPeriod('month');

        $manager->persist($advertisement);
        $manager->flush();

        $this->addReference('advertisement_' . $i, $advertisement);

        return $advertisement;
    }
}