<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;


class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByNameDESC()
    {
        return $this->getEntityManager()
            ->createQuery(/** @lang text */
                'SELECT p,c
        FROM AppBundle:Product p
        JOIN p.category c
        ORDER BY p.name DESC
        ')
            ->getResult();
    }

    public function findAllOrderedByNameASC()
    {
        return $this->getEntityManager()
            ->createQuery(/** @lang text */
                'SELECT p,c
        FROM AppBundle:Product p
        JOIN p.category c
        ORDER BY p.name ASC
        ')
            ->getResult();
    }

    public function getListWithCategories()
    {
        $query = $this->getEntityManager()->createQuery(/** @lang text */
            'SELECT p,c
        FROM AppBundle:Product p
        JOIN p.category c');

        return $query->getResult();
    }

    public function findAllOrderedByPriceDESC()
    {
        return $this->getEntityManager()
            ->createQuery(/** @lang text */
                'SELECT p,c
        FROM AppBundle:Product p
        JOIN p.category c
        ORDER BY p.price DESC
        ')
            ->getResult();
    }

    public function findAllOrderedByPriceASC()
    {
        return $this->getEntityManager()
            ->createQuery(/** @lang text */
                'SELECT p,c
        FROM AppBundle:Product p
        JOIN p.category c
        ORDER BY p.price ASC
        ')
            ->getResult();
    }


    public function findDescriptionText($id)
    {
        $result = $this->getEntityManager()
            ->createQuery(/** @lang text */
                'SELECT  p.description
            FROM AppBundle:Product p
            WHERE p.id=:id
            ')
            ->setParameter('id', $id)
            ->getResult();
        return $result;
    }
}