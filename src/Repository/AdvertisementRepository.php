<?php
namespace App\Repository;

use App\Entity\AdvertisementEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AdvertisementRepository extends ServiceEntityRepository
{
    /**
     * Constructor
     * 
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdvertisementEntity::class);

        $this->em = $this->getEntityManager();
    }

    /**
     * Create Advertisement
     * 
     * @param AdvertisementEntity $advertisement
     * 
     * @return AdvertisementEntity
     */
    public function create(AdvertisementEntity $advertisement): AdvertisementEntity
    {
        $this->em->persist($advertisement);
        $this->em->flush();

        return $advertisement;
    }
}
