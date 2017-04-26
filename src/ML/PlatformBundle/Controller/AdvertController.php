<?php

// src/ML/PlatformBundle/Controller/AdvertController.php

namespace ML\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{

//ACCUEIL DE LA PLATFORM
public function indexAction($page)
{
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
	
	if ($page < 1) {
    
    // On déclenche une exception NotFoundHttpException, cela va afficher
    // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
	
	throw new NotFoundHttpException('Page "'.$page.'" inexistante.');

	}

	 // Liste d'annonces pour exemple
    $listAdverts = array(
      array(
        'title'   => 'Nous cherchons des endives...',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => '1,5kg d\'endives pour une salade.',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission Topinambours',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Recherche des topinambour en toute discrétion...',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mon figuier porte trop de figues !',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Impossible de toutes les récolter seul ! Je suis envahi ! HEELLLLP !',
        'date'    => new \Datetime())
    );

    // Et modifiez le 2nd argument pour injecter notre liste
    return $this->render('MLPlatformBundle:Advert:index.html.twig', array(
      'listAdverts' => $listAdverts
    ));
}


 //POUR RECHERCHER UNE ANNONCE AVEC UN TAG
public function viewAction($id, Request $request) {
    
    // Ici, on récupère l'annonce correspondante à l'id $id

    $advert = array(
      'title'   => 'Recherche patates douces',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Qui a des patates douces pour changer ? Merci.',
      'date'    => new \Datetime()
    );

	return $this->render('MLPlatformBundle:Advert:view.html.twig', array(
      'advert' => $advert));

}



//POUR AFFICHER DES ANNONCES PAR CATEGORIES
public function viewSlugAction($slug, $year, $format) {
	
	return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format.".");
}

//POUR AJOUTER UNE ANNONCE
public function addAction(Request $request) {

	  // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
	  if ($request->isMethod('POST')) {
	  // Ici, on s'occupera de la création et de la gestion du formulaire

	  $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

	  // Puis on redirige vers la page de visualisation de cettte annonce
	  return $this->redirectToRoute('ml_platform_view', array('id' => 5));
	}

	  // Si on n'est pas en POST, alors on affiche le formulaire
	  return $this->render('MLPlatformBundle:Advert:add.html.twig');
}

public function editAction($id, Request $request) {

	// Ici, on récupérera l'annonce correspondante à $id

	// Même mécanisme que pour l'ajout
	if ($request->isMethod('POST')) {
	  $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

	  return $this->redirectToRoute('ml_platform_view', array('id' => 5));
	}

    $advert = array(
      'title'   => 'Recherche asperges',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Asperges ! Asperges ! Aspeeeeerges !!',
      'date'    => new \Datetime()
    );

    return $this->render('MLPlatformBundle:Advert:edit.html.twig', array(
      'advert' => $advert
    ));

}


public function deleteAction($id) {
	// Ici, on récupérera l'annonce correspondant à $id

	// Ici, on gérera la suppression de l'annonce en question

	return $this->render('MLPlatformBundle:Advert:delete.html.twig');
}


public function menuAction() {
	// On fixe en dur une liste ici, bien entendu par la suite
	// on la récupérera depuis la BDD !
	$listAdverts = array(
	  array('id' => 2, 'title' => 'Recherche carottes et pommes de terre'),
	  array('id' => 5, 'title' => 'J\'ai des endives !'),
	  array('id' => 9, 'title' => 'Qui veut de la belle tomate ?')
	);

	return $this->render('MLPlatformBundle:Advert:menu.html.twig', array(
	  // Tout l'intérêt est ici : le contrôleur passe
	  // les variables nécessaires au template !
	  'listAdverts' => $listAdverts
	));
  }


}

	//GENERER UNE URL AVEC ARGUMENT
    	/*
    	$url = $this->get('router')->generate(
            'ml_platform_view', // 1er argument : le nom de la route
            array('id' => 5)    // 2e argument : les valeurs des paramètres
        );
        */

    //GENERER UNE URL
//			$url = $this->generateUrl('ml_platform_home');        
//			return new Response("L'URL de l'annonce d'id 5 est : ".$url);

    //GENERER UN TEMPLATE
//			$content = $this->get('templating')->render('MLPlatformBundle:Advert:index.html.twig');
//			return new Response($content);

	//POUR APPELER UN TEMPLATE (version courte)
//			return $this->render('MLPlatformBundle:Advert:index.html.twig');

	//POUR FAIRE UNE REDIRECTION :
/*
		return $this->redirectToRoute('ml_platform_home');
*/

	//POUR CHANGER LE FORMAT DE LA REPONSE

/*
		use Symfony\Component\HttpFoundation\JsonResponse;

		// ...

		public function viewAction($id)
		{
		  return new JsonResponse(array('id' => $id));
		}
*/

	//POUR GERER LES VARIABLES SESSION
/*
	    // Récupération de la session
	    $session = $request->getSession();
	    
	    // On récupère le contenu de la variable user_id
	    $userId = $session->get('user_id');

	    // On définit une nouvelle valeur pour cette variable user_id
	    $session->set('user_id', 91);

*/

	//POUR UN ENVOI PAR MAIL

	// Depuis un contrôleur
/*
		$contenu = $this->renderView('MLPlatformBundle:Advert:email.txt.twig', array(
		  'var1' => $var1,
		  'var2' => $var2
		));

		// Puis on envoie l'e-mail, par exemple :
		mail('moi@gmail.com', 'Inscription OK', $contenu);
*/