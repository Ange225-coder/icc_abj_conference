<?php
/**
 * this controller contain a form for attendees registration
 */

    namespace App\Controller\Public;

    use App\Entity\Public\Attendees;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Form\Fields\Public\AttendeesRegistrationFields;
    use App\Form\Type\Public\AttendeesRegistrationType;

     class HomeController extends AbstractController
     {
         private RequestStack $requestStack;
         private EntityManagerInterface $entityManager;


         public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
         {
             $this->entityManager = $entityManager;
             $this->requestStack = $requestStack;
         }


         #[Route(path: '/', name: 'home')]
         public function home():Response
         {
             $attendeesRegistrationFields = new AttendeesRegistrationFields();
             $attendeesEntity = new Attendees();

             $attendeesRegistrationType = $this->createForm(AttendeesRegistrationType::class, $attendeesRegistrationFields);

             $request = $this->requestStack->getCurrentRequest();

             $attendeesRegistrationType->handleRequest($request);

             if($attendeesRegistrationType->isSubmitted() && $attendeesRegistrationType->isValid()) {

                 $existingEmail = $this->entityManager->getRepository(Attendees::class)->findOneBy([
                     'email' => $attendeesRegistrationFields->getEmail(),
                 ]);

                 $existingPhone = $this->entityManager->getRepository(Attendees::class)->findOneBy([
                     'phone' => $attendeesRegistrationFields->getPhone(),
                 ]);

                 if($existingEmail) {
                     $attendeesRegistrationType->get('email')->addError(new FormError('Cet email est déjà utilisé par un autre participant'));
                 }

                 if($existingPhone) {
                     $attendeesRegistrationType->get('phone')->addError(new FormError('Ce numéro de téléphone est déjà utilisé par un autre participant'));
                 }

                 //display errors in rendering if they exist
                 if($attendeesRegistrationType->getErrors(true)->count()) {
                     return $this->render('public/home.html.twig', [
                         'attendeesRegistrationForm' => $attendeesRegistrationType,
                     ]);
                 }

                 $attendeesEntity->setEmail($attendeesRegistrationFields->getEmail());
                 $attendeesEntity->setPhone($attendeesRegistrationFields->getPhone());
                 $attendeesEntity->setLastName($attendeesRegistrationFields->getLastName());
                 $attendeesEntity->setFirstName($attendeesRegistrationFields->getFirstName());
                 $attendeesEntity->setNewsletter($attendeesRegistrationFields->getNewsletter());

                 $this->entityManager->persist($attendeesEntity);
                 $this->entityManager->flush();

                 $this->addFlash('attendees_registration_success', 'Votre demande de participation à bien été prise en compte');

                 return $this->redirectToRoute('home');
             }

             return $this->render('public/home.html.twig', [
                 'attendeesRegistrationForm' => $attendeesRegistrationType,
             ]);
         }
     }