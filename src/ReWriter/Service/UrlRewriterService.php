<?php
namespace ReWriter\Service;

use Doctrine\ORM\EntityManager;
use ReWriter\Entity\Url;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UrlRewriterService
 * @package ReWriter\Service
 */
class UrlReWriterService
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UrlRewriterService constructor.
     * @param EntityManager $entityManager
     */
    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $slug
     * @return object|null
     */
    public function fetchBySlug(string $slug)
    {
        return $this->entityManager->getRepository(Url::class)->findOneBy(['slug' => $slug]);
    }

    /**
     * @return array|object[]
     */
    public function fetchAll()
    {
        return $this->entityManager->getRepository(Url::class)->findAll();
    }

    /**
     * @param Request $request
     * @return Url
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFromRequest(Request $request)
    {
        $location = $request->request->get('location');
        if(!filter_var($location, FILTER_SANITIZE_URL)) {
            return null;
        }

        $url = new Url();
        $url->setLocation($location);
        $url->setSlug(uniqid());

        $this->entityManager->persist($url);
        $this->entityManager->flush($url);

        return $url;
    }

}