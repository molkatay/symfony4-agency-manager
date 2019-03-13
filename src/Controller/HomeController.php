<?php
/**
 * Created by PhpStorm.
 * User: Molka TAYAHI
 * Date: 18/11/2018
 * Time: 14:35
 */
namespace App\Controller;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository):Response{

        $properties = $repository->findLatest();
        dump($properties);
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
}