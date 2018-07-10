<?php

namespace snakemkua\Warp12Bundle\Controller;

use snakemkua\Warp12Bundle\Entity\Slug;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SlugController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function updateCurrent(Slug $slug) {
        $rep = $this->getDoctrine()->getRepository('Warp12Bundle:Slug');
        $query = $rep->createQueryBuilder('s');
        $query
            ->update()
            ->set('s.current', 0)
            ->where($query->expr()->notIn('s.id', [$slug->getId()]))
            ->andWhere('s.targetId = :targets')
            ->andWhere('s.class = :class')
            ->setParameter('targets', $slug->getTargetId())
            ->setParameter('class', $slug->getClass());
        $query->getQuery()->execute();
    }
}
