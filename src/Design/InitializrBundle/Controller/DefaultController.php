<?php

namespace Design\InitializrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Design\InitializrBundle\Entity\Personne;
use Design\InitializrBundle\Entity\Membre;
use Design\InitializrBundle\Form\PersonneType;
use Design\InitializrBundle\Form\MembreType;
use Design\InitializrBundle\Entity\Mail;
use Design\InitializrBundle\Form\MailType;
use Design\InitializrBundle\Entity\Stage;
use Design\InitializrBundle\Form\StageType;
use Design\InitializrBundle\Entity\Cours;
use Design\InitializrBundle\Form\CoursType;

use Design\InitializrBundle\Resources\Logger;

class DefaultController extends Controller
{
	public function membreAction()
	{
		return $this->render('DesignInitializrBundle:Default:membre.html.twig');
	}
	
	public function profilAction()
	{
		//$user = $this->get('security.context')->getToken()->getUser();
		$user = $this->getUser();
	
		$msg = $user->toString();
	
		return $this->render('DesignInitializrBundle:Default:profil.html.twig', array("msg" => $msg, "user" => $user));
	}
	
	public function coursAction()
	{
		$msg = 0;
		$stages = $this->getUser()->getIdPersonneMembre()->getIdStageParticipe();
		$cours = new \Doctrine\Common\Collections\ArrayCollection();
	
		// On récupère le repository des cours
		$repository = $this	->getDoctrine()
		->getManager()
		->getRepository('DesignInitializrBundle:Cours');
		$cpt = 0;
		foreach ($stages as $s)
		{
			// on cherche si ce stage est un cours
			$c = $repository->findOneByIdStageCours( $s->getIdStage() );
			if($c != null) // si oui
			{
				// on l'ajoute a la liste des cours
				$cours[] = $c;
				// on l'enleve de la liste de stage
				unset($stages[$cpt]);
			}
			$cpt += 1;
		}
		unset($cpt);
	
		return $this->render('DesignInitializrBundle:Default:cours.html.twig',
				array( 'stages' => $stages, 'cours' => $cours, 'msg' => $msg ));
	}
	
	public function testAction()
	{
		$msg = array();
		$cpt = 0;
		
		$em = $this->getDoctrine()->getManager();
		$q = $em->createQuery(
		    '	SELECT m
		    	FROM DesignInitializrBundle:Membre m, DesignInitializrBundle:Personne p
		    	WHERE p = m.idPersonneMembre
				AND p.mail = :mail	'
		)->setParameter('mail', "jumerion@gmail.com");
		
		$membres = $q->getSingleResult();
		
		$msg[0] = $membres->toString();
		
		/*
		foreach ($membres as $membre)
		{
			$msg[$cpt] = $membre->toString();
			++$cpt;
		}*/
		
		return $this->render('DesignInitializrBundle:Default:test.html.twig',
				array( 'msg' => $msg ));
	}
	
	public function loginAction()
    {
    	$request = $this->getRequest();
		$session = $request->getSession();
        
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        	$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render('DesignInitializrBundle:Default:login_form.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

	public function helloAction($name)
	{
		return $this->render('DesignInitializrBundle:Default:hello.html.twig',
							  array( 'name' => $name ));
	}

    public function indexAction()
    {
        return $this->render('DesignInitializrBundle:Default:index.html.twig');
    }
    
    public function contactAction()
    {
    	$err = "";
    	$existe = false;
    	$personne = new Personne();
    	$mail = new Mail();
    	
    	$form = $this->createForm(new MailType(), $mail);
    	
    	// On récupère la requête
	    $request = $this->get('request');
	    
	    // On vérifie qu'elle est de type POST
	    if ($request->getMethod() == 'POST')
	    {
			/*
			 * Lien Requête <-> Formulaire
			 * A partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire par le visiteur
			 */
			$form->handleRequest($request);
    	
	    	if ($form->isValid())
	    	{
	    		$formPers = $request->request->get('mail', 'personne');
	    		$formPers = $formPers['personne'];
	    		
	    		$personne = new Personne();
	    		$personne->persInit($formPers['nom'],
	    							$formPers['prenom'],
	    							$formPers['mail'],
	    							$formPers['tel']);
	    		
	    		/*debug ###
	    		$err .=	print_r($personne, true);
	    		$err .= " -###- ";
	    		$err .=	print_r($formPers, true);
	    		$err .= " ".print_r($mail->getDateEnvoi(), true);
	    		//######### */
	    		
	    		if( $this->existeBDD($personne) )
	    			$existe = true;
/*	    		else if( $this->estMembre($personne) )
		    		$err = "Membre déjà inscrit.";
*/	    		
	    		
				if( $err == "" )
    			{
    				$mail->setExpediteur($personne);
    				
    				
	    			$em = $this->getDoctrine()->getManager();	// On choppe le manager
	    			
	    			
	    			$em->persist($personne);	// On enregistre notre objet dans la base de données
	    			$em->flush();	// On valide
	    			
	    			$em->persist($mail);	// On enregistre notre objet dans la base de données
	    			$em->flush();	// On valide
	    			
	    			// On redirige vers la page de visualisation de l'article nouvellement créé
	    			return $this->redirect($this->generateUrl(	'design_initializr_homepage' ));
    			}
	    	}	    	
	    }
	    
    	return $this->render(	'DesignInitializrBundle:Default:contact_form.html.twig',
    							array(	'form' => $form->createView(),
    									'err' => $err	));
    }
    
    public function agendaAction()
    {    	
    	$err = "";
    	$courst = $this->getCoursStages();
    	 
    	$stages = $courst[0];
    	$cours = $courst[1];
    	
    	$astages = array();
    	$acourss = array();
    	
    	
    	foreach($stages as $stage)
    		$astages[] = $stage->toArray();
    	foreach($cours as $c)
    		$acourss[] = $c->toArray();
    	
    	$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new GetSetMethodNormalizer());
		
		$serializer = new Serializer($normalizers, $encoders);
		
    	$jstages = $serializer->serialize($astages, 'json');
    	$jcours = $serializer->serialize($acourss, 'json');
    	
    	/*
    	var_dump($jstages);
    	var_dump($jcours);
    	*/
    	//throw new \Exception("Test:\n\t"+$test);
    	
    	return $this->render(	'DesignInitializrBundle:Default:agenda.html.twig',
    							array(	'stages' => $jstages,
    									'cours' => $jcours,
    									'err' => $err	));
    }

    public function inscriptionStageAction()
    {
    	// === same type & value
    	
    	// non membre -> ne peut pas s'inscrire
    	if (false === $this->get('security.context')->isGranted('ROLE_USER'))
    		return new JsonResponse($reponse['success'] = false);
    	
    	
    	//On recup le user
    	$user = $this->get('security.context')->getToken()->getUser();
    	Logger::getInstance()->log( $user->toString() );
    	
    	//On récupère l'identifiant et le mdp de l'AJAX (POST)
    	$request = Request::createFromGlobals();
    	
    	$identifiant = $request->request->get('identifiant');
    	
    	if(true)
    	{
    		$reponse['success'] = true;
    	}
    	else
    	{
    		$reponse['success'] = false;
    	}
    	
    	$loga = Logger::getInstance();
    	$loga->log($identifiant . " - \$reponse[\'success\'] = " . $reponse['success']);
    	
    	return new JsonResponse($reponse);
    }
    
    public function menuAction()
    {
    	// On récupère le repository
    	$repository = $this	->getDoctrine()
					    	->getManager()
					    	->getRepository('DesignInitializrBundle:Rubriques');
    	 
    	// On récupère les entités
    	$menus = $repository->findAll();

    	return $this->render('DesignInitializrBundle:Default:menu.html.twig', array('menus' => $menus));
    }
    
    public function connectAction()
    {
    	return $this->render('DesignInitializrBundle:Default:connect_form.html.twig');
    }

    public function inscriptionAction()
    {
    	$err = "";
    	$membre = new Membre();
    	
    	$form = $this->createForm(new MembreType(), $membre);
    	
    	// On récupère la requête
	    $request = $this->get('request');
	    
	    // On vérifie qu'elle est de type POST
	    if ($request->getMethod() == 'POST')
	    {
			/*
			 * Lien Requête <-> Formulaire
			 * A partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire par le visiteur
			 */
			$form->handleRequest($request);
    	
	    	if ($form->isValid())
	    	{
	    		$formPers = $request->request->get('membre', 'personne');
	    		$formPers = $formPers['personne'];
	    		
	    		$personne = new Personne();
	    		$personne->persInit($formPers['nom'],
	    							$formPers['prenom'],
	    							$formPers['mail'],
	    							$formPers['tel']);
	    		
	    		/* //debug ###
	    		$err .=	print_r($personne, true);
	    		$err .= " -###- ";
	    		$err .=	print_r($formPers, true);
	    		//######### */
	    		
	    		if( $this->existeBDD($personne) )
	    			$err = "Cette personne existe déjà.";
	    		else if( $this->estMembre($personne) )
		    		$err = "Membre déjà inscrit.";
	    		
				if( $err == "" )
    			{
    				// on lie le membre avec la personne
    				$membre->setIdPersonneMembre($personne);
    				
    				// on genere le salt du membre
    				$membre->setSaltMembre( md5(time()) );
    				
    				// on crypt le mdp
    				$this->cryptSHA512($membre);
    				
	    			$em = $this->getDoctrine()->getManager();	// On choppe le manager
	    				    			
	    			$em->persist($personne);	// On enregistre notre objet dans la base de données
	    			$em->flush();	// On valide
	    			
	    			
	    			
	    			$em->persist($membre);	// On enregistre notre objet dans la base de données
	    			$em->flush();	// On valide
	    			
	    			// On redirige vers la page de visualisation de l'article nouvellement créé
	    			return $this->redirect($this->generateUrl(	'design_initializr_homepage' ));
    			}
	    	}	    	
	    }
	    
    	return $this->render(	'DesignInitializrBundle:Default:inscription_form.html.twig',
    							array(	'form' => $form->createView(),
    									'err' => $err	));
    }
    
    /**
     * Teste l'existence dans la base:
     * 	\Design\InitializrBundle\Entity\Personne : couple nom/prenom	
     *
     * @param none $var
     * @return boolean
     */
    public function existeBDD($var)
    {
    	$class = $var->getClass();
    	
    	// On recupere le repository
    	$repository = $this	->getDoctrine()
					    	->getManager()
					    	->getRepository('DesignInitializrBundle:' . $class );
    	
    	if( $class == "Personne" )
	    	$query = $repository->findOneBy(array('mail' => $var->getMail()));
    	else
    		$query = null;
    	
    	if($query == null)
    		return false;
    	else
    		return true;   	
    }
    
    public function estMembre(\Design\InitializrBundle\Entity\Personne $personne)
    {
    	$repository = $this	->getDoctrine()
					    	->getManager()
					    	->getRepository('DesignInitializrBundle:Membre');
    	
    	$query = $repository->findOneBy( array('idPersonneMembre' => $personne/*->getIdPersonne()*/) );
    	
    	if($query == null)
    		return false;
    	else
    		return true;
    }
    
    /**
     * crypte le mdp du membre passe en param
     */
    public function cryptSHA512(\Design\InitializrBundle\Entity\Membre $membre)
    {
    	// Génération d'un salt
    	// $salt = md5(time());
		// genere dans constructeur de membre en fait
    	
    	$factory = $this->get('security.encoder_factory');
    	
    	$encoder = $factory->getEncoder($membre);
    	$password = $encoder->encodePassword( $membre->getMdpMembre(), $membre->getSalt() );
    	
    	$membre->setMdpMembre($password);
    }
    
    public function adminAction()
    {
    	return $this->render('DesignInitializrBundle:Default:admin.html.twig');
    }

    public function getCoursStages()
    {
    	// On récupère le repository
    	$repository = $this	->getDoctrine()
					    	->getManager()
					    	->getRepository('DesignInitializrBundle:Stage');
    	$stages = $repository->findAll();
    	
    	// On récupère le repository
    	$repository = $this	->getDoctrine()
					    	->getManager()
					    	->getRepository('DesignInitializrBundle:Cours');
    	$cours = $repository->findAll();
    	 
    	// on enleve tous les cours contenus dans $stages
    	$count = count($stages);
    	foreach ($cours as $c)
    	{
    		$key = array_search($c->getIdStageCours(), $stages);
    		if($key!==false)
    		{
    			unset($stages[$key]);
    		}
    	}
    	
    	return array($stages,$cours);
    }
    
    public function admincoursstagesAction()
    {
    	$err = "";
    	$courst = $this->getCoursStages();
    	
    	$stages = $courst[0];
    	$cours = $courst[1];
    	
    	return $this->render(
    		'DesignInitializrBundle:Default:voir_coursstages.html.twig',
			array( 	'stages' => $stages,
					'cours' => $cours, 
					'err' => $err 	));
    }

    public function adminmembresAction()
    {
    	$err = "";
    	
    	// On récupère le repository
    	$repository = $this	->getDoctrine()
					    	->getManager()
					    	->getRepository('DesignInitializrBundle:Membre');
    	 
    	
    	if( isset($_GET['nom']) && isset($_GET['prenom']) )
    		if( $_GET['nom'] != "" && $_GET['prenom'] != "" )
    		{
    			$rep = $this	->getDoctrine()
				    			->getManager()
				    			->getRepository('DesignInitializrBundle:Personne');
    			 
    			$personne = $rep->findOneBy( array('nom' => $_GET['nom'], 'prenom' => $_GET['prenom']) );
    			//$personne = null;
    			if($personne == null)
    				$err .= "Cette personne n'existe pas dans la base";
    			else
    			{
	    			$membre = $repository->findOneBy( array('idPersonneMembre' => $personne) );
	    			if($membre == null)
	    				$err .= "Cette personne ne s'est pas inscrite";
	    			else
	    			{
	    				$membre->setEstValideMembre(true);
	    				
	    				$em = $this->getDoctrine()->getManager();	// On choppe le manager
	    				$em->persist($membre);	// On enregistre notre objet dans la base de données
	    				$em->flush();	// On valide
	    			}
	    			
	    			// On rerécupère le repository
	    			$repository = $this	->getDoctrine()
						    			->getManager()
						    			->getRepository('DesignInitializrBundle:Membre');
    			}
    		}
	    	 
    	// On récupère les entités
    	$membres = $repository->findAll();
    	if($membres == null)
    		$err .= "aucun membre yo";
    	
    	return $this->render(	'DesignInitializrBundle:Default:voir_membres.html.twig',
    							array('membres' => $membres, 'err' => $err)		);
	}
	
	// $nomStage : le nom unique du stage a modif
	// gere le formulaire de modif de stage
	public function modStageAction($nomStage)
	{
		$err = "";
		$stage = null;
		
		if($nomStage != "")
		{
			if($nomStage == "nouvStage") // creation d'un stage
			{
				// nouvelle instance de stage
				$stage = new Stage();
			}
			else // modification d'un stage
			{
				$repository = $this	->getDoctrine()
									->getManager()
									->getRepository('DesignInitializrBundle:Stage');
				
				$stage = $repository->findOneBy( array('nomStage' => $nomStage) );
			}
			
			if($stage == null)
				$err .= "erreur : ce stage n'existe pas... ||";
			else
			{
				//creer le form, eazzle peazzle
				$form = $this->createForm(new StageType(), $stage);
				 
				// On récupère la requête
				$request = $this->get('request');
				 
				// si POST
				if ($request->getMethod() == 'POST')
				{
					$form->handleRequest($request);   // donnees inscrites dans l'objet $request
                    
					 
					if ($form->isValid())
					{
						$em = $this->getDoctrine()->getManager();	// On choppe le manager
						$em->persist($stage);	// On enregistre notre objet dans la base de données
						$em->flush();	// On valide
						
						/* Job Done ! on redirige */
                        return $this->redirect($this->generateUrl(	'design_initializr_admin_coursStages' ));
					}
					else 
						$err .= "Formulaire invalide || "; 
				}
			} 
		}
		else // si aucun nom n'est renseigne (ne devrait pas arriver)
		{
			$stage = null;
			$err .= "erreur : aucun stage demandé...";
		}
		
		return $this->render(	'DesignInitializrBundle:Default:stage_form.html.twig',
								array('form' => $form->createView(), 'err' => $err)		);
	}


    /*
     * gere le formulaire de cours
     * 
     * $nomCours : le nom unique du stage a modif
     * ou "nouvCours" pour creer un cours
     */
    public function modCoursAction($nomCours)
    {
        $err = "";
        $cours = null;

        if($nomCours != "")
        {
            if($nomCours == "nouvCours") // creation d'un cours
			{
				$cours = new Cours();
			}
			else // modification d'un cours
			{
	            /*
	            $em = $this->getDoctrine()->getManager();	// On choppe le manager
	            $query = $em->createQuery
	            ('
	                SELECT c
	                FROM	DesignInitializrBundle:Cours c, 
	            			DesignInitializrBundle:Stage s
	                WHERE 	c.idStageCours = s.idStage
	            	AND		s.nomStage = :nom
	            ')->setParameter('nom', $nomCours);
	
	            $cours = $query->getResult();
	            */
	            
	        	
	            /* Ameliorer la requete */
	        	$repository = $this	->getDoctrine()
						        	->getManager()
						        	->getRepository('DesignInitializrBundle:Cours');
	            $touslescours = $repository->findAll();
	            
	            foreach ($touslescours as $cour)
	            	if($cour->getIdStageCours()->getNomStage() == $nomCours)
	            	{
	            		$cours = $cour;
	            		break;
	            	}
			}
            
            if($cours == null)
                $err .= "erreur : ce cours n'existe pas... ||";
            else
            {
                //creer le form, eazzle peazzle
                $form = $this->createForm(new CoursType(), $cours);

                // On récupère la requête
                $request = $this->get('request');

                // si POST
                if ($request->getMethod() == 'POST')
                {
                    //$form->handleRequest($request);   // donnees inscrites dans l'objet $request
                    $form->handleRequest($request);

                    if ($form->isValid())
                    {
                        $em = $this->getDoctrine()->getManager();	// On choppe le manager
                        $em->persist($cours->getIdStageCours());	// On persiste le stage d'abord
                        $em->flush();	// apparemment faut flush entre les 2
                        $em->persist($cours);	// Puis le cours
                        $em->flush();	// On valide

                        /* Job Done ! on redirige */
                        return $this->redirect($this->generateUrl(	'design_initializr_admin_coursStages' ));
                    }
                    else
                        $err .= "Formulaire invalide /O.O\ ";
                }
            }
        }
        else // si aucun nom n'est renseigne (ne devrait pas arriver)
        {
            $stage = null;
            $err .= "erreur : aucun stage demandé...";
        }

        return $this->render(	'DesignInitializrBundle:Default:cours_form.html.twig',
                                array('form' => $form->createView(), 'err' => $err)		);
    }
}