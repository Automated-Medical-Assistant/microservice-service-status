<?php declare(strict_types=1);


namespace App\Tests\Integration;


use App\MessageHandler\NumberListMessageHandler;
use App\Repository\NumberListRepository;
use App\Repository\NumberListWriteRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use MessageInfo\NumberAPIDataProvider;
use MessageInfo\NumberListAPIDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NumberListSaveTest extends KernelTestCase
{
    /**
     * @var NumberListMessageHandler $numberHandler
     */
    private NumberListMessageHandler $numberHandler;
    /**
     * @var NumberListRepository|object|null
     */
    private $numberRepository;
    /**
     * @var EntityManager|object|null
     */
    private $entityManager;

    protected function setUp()
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->numberHandler = new NumberListMessageHandler(
            self::$container->get(NumberListWriteRepositoryInterface::class)
        );
        $this->numberRepository = self::$container->get(NumberListRepository::class);
        $this->entityManager = self::$container->get(EntityManagerInterface::class);
    }
    
    protected function tearDown(): void
    {
        parent::tearDown();
        $con = $this->entityManager->getConnection();
        $con->query('TRUNCATE number_list');
    }

    public function testCollectionInsertCount()
    {
        $numberListDto = $this->generateTestData(10);
        $this->triggerInsert($numberListDto);

        $result = $this->numberRepository->findAll();
        $this->assertCount(10, $result);
    }

    public function testNumberInsertContent()
    {
        $numberListDto = $this->generateTestData(1);
        $this->triggerInsert($numberListDto);

        $result = $this->numberRepository->findBy(['number' => 'NUMBER1']);

        $this->assertCount(1, $result);
        $this->assertSame('NUMBER1', $result[0]->getNumber());
    }

    /**
     * @return NumberListAPIDataProvider
     * @throws \Exception
     */
    private function generateTestData(int $count): NumberListAPIDataProvider
    {
        $numberListDto = new NumberListAPIDataProvider();

        for ($i = 0; $i < $count; $i++) {
            $numberDto = new NumberAPIDataProvider();
            $numberDto->setNumber('NUMBER'.$count);
            $numberDto->setDoctorId(random_int(1, 100));
            $numberDto->setCreationDate((new \DateTime())->format('Y-m-d H:i:s'));
            $numberDto->setStatus((bool)random_int(0, 1));
            $numberListDto->addaddNumber($numberDto);
        }

        return $numberListDto;
    }

    /**
     * @param NumberListAPIDataProvider $numberListDto
     */
    private function triggerInsert(NumberListAPIDataProvider $numberListDto): void
    {
        $numberHandler = $this->numberHandler;
        $numberHandler($numberListDto);
    }
}
