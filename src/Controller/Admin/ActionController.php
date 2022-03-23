<?php

namespace App\Controller\Admin;

use App\Entity\TraitEntity;
use App\Form\ActionType;
use App\Repository\RepositoryEntityRepository;
use App\Service\TraitFinder;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    #[Route(path:'/actions', name: 'admin_actions')]
    public function index(Request $request, TraitFinder $traitFinder, RepositoryEntityRepository $repositoryEntityRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActionType::class, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->getClickedButton()) {
                switch ($form->getClickedButton()->getName()) {
                    case 'field_submit_run_repository_explorer_all':
                        foreach ($repositoryEntityRepository->findAll() as $repositoryEntity) {
                            $owner = $repositoryEntity->getOwner();
                            $repository = $repositoryEntity->getRepository();
                            $version = $repositoryEntity->getVersion();
                            foreach ($traitFinder->findAllFiles($owner, $repository, $version) as $file) {
                                $trait = new TraitEntity();
                                $trait->setRepositoryEntity($repositoryEntity);
                                $trait->setCode($traitFinder->getFileContent($file));
                                $entityManager->persist($trait);
                            }
                            $repositoryEntity->setLastScan(new DateTime());
                            $entityManager->persist($repositoryEntity);
                            $entityManager->flush();
                        }
                        break;
                    case 'field_submit_run_repository_explorer_selected':
                        dump($traitFinder->findAllFiles('emircanerkul', 'weather-api', 'master'));
                        break;
                    default:
                        break;
                }
                $this->addFlash('success', 'All repositories successfully checked.');
            }
        }

        return $this->renderForm('action/index.html.twig', [
            'form' => $form,
        ]);
    }
}
