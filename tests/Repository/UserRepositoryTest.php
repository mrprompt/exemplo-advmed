<?php
namespace App\Tests\Repository;

use App\Entity\UserEntity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var UserEntity
     */
    protected $obj;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
        $this->obj = $this->em->getRepository(UserEntity::class);
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        parent::tearDown();
        
        $this->em->close();

        $this->em = null;
        $this->obj = null;
    }

    /**
     * @test
     * @covers \App\Repository\UserRepository::__construct
     * @covers \App\Repository\UserRepository::create
     * @expectedException \Doctrine\DBAL\Exception\NotNullConstraintViolationException
     */
    public function createWithUnpopulatedEntityThrowsException()
    {
        $result = $this->obj->create(new UserEntity());
    }

    /**
     * @test
     * @covers \App\Repository\UserRepository::__construct
     * @covers \App\Repository\UserRepository::update
     * @expectedException \BadMethodCallException
     */
    public function update()
    {
        $result = $this->obj->update(1, new UserEntity());
    }
}
