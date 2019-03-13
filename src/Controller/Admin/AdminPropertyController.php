<?php
namespace App\Controller\Admin;
use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController{

    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * AdminPropertyController constructor.
     * @param PropertyRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository= $repository;
        $this->em = $em;
    }

    /**
 * @Route("/admin", name="admin.property.index")
 */
    public function index(){
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/bien/create", name="admin.property.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request){
        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succés');

            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
* @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
* @param Property $property
* @return \Symfony\Component\HttpFoundation\Response
*/
    public function edit(Property $property, Request $request){

        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succés');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     */
    public function delete(Property $property, Request $request){
        if($this->isCsrfTokenValid('delete'.$property->getId(), $request->get('_token'))){
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succés');

        }

        return $this->redirectToRoute('admin.property.index');
    }
}