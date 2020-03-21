<?php declare(strict_types=1);


namespace App\Repository;


use App\Entity\NumberList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use MessageInfo\NumberListAPIDataProvider;

class NumberListWriteRepository extends ServiceEntityRepository implements NumberListWriteRepositoryInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private \Doctrine\ORM\EntityManager $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumberList::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function insertCollection(NumberListAPIDataProvider $numberList)
    {
        foreach ($numberList->getSetNumbers() as $number){
                $numberEntity = new NumberList();
                $numberEntity->setDoctorId($number->getDoctorId());
                $numberEntity->setNumber($number->getNumber());
                $numberEntity->setCreationDate(new \DateTime($number->getCreationDate()));
                $numberEntity->setStatus($number->getStatus());
                $this->entityManager->persist($numberEntity);
        }
        $this->entityManager->flush();
    }
}
