<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class WomenController extends AbstractController
{
    #[Route('/women', name: 'app_women')]
    public function index(Connection $connection)
    {
        $query = "SELECT * FROM employees WHERE gender = 'F'";
        $stmt = $connection->prepare($query);
        $stmt->executeQuery();
        $employees = $stmt/*->fetchAllAssociative()*/;
        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }
        
    /*#[Route('/women', name: 'app_women')]
    public function index(): Response
    {
        return $this->render('women/index.html.twig', [
            'controller_name' => 'WomenController',
        ]);
    }*/
    /*#[Route('/all', name: 'app_women_all')]
    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function onlyWomen(): array
    {
        $conn = $this->getEmployeeEntity()->getConnection();

        $sql = '
            SELECT * FROM product p
            WHERE p.price > :price
            ORDER BY p.price ASC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['price' => $price]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    {
        $em = $this->doctrine->getManager();
        $query = $em->createQueryBuilder()
            ->select('e')
            ->from('App:Employee', 'e')
            ->where('e.gender = :gender')
            ->setParameter('gender', 'F')
            ->getQuery();
        $employees = $query->getResult();
        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }*/
}
