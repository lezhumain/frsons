<?php 
// src/Design/InitializrBundle/Entity/MembreRepository.php
namespace Design\InitializrBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

use Design\InitializrBundle\Resources\Logger;

class MembreRepository extends EntityRepository implements UserProviderInterface
{
	public function findOneByUsername($username)
	{
		Logger::getInstance()
			->log(" - MembreRepository::findOneByUsername($username)");
		
		return $this->loadUserByUsername($username);
	}
	
	public function loadUserByUsername($username)
	{
		$em = $this	->getEntityManager();
		$q = $em->createQuery('
				SELECT m
		    	FROM DesignInitializrBundle:Membre m, DesignInitializrBundle:Personne p
		    	WHERE p = m.idPersonneMembre
				AND p.mail = :mail
		')->setParameter('mail', $username);

		try {
			// La méthode Query::getSingleResult() lance une exception
			// s'il n'y a pas d'entrée correspondante aux critères
			$user = $q->getSingleResult();
		} catch (NoResultException $e) {
			throw new UsernameNotFoundException(sprintf('Unable to find an active user DesignInitializrBundle:User object identified by "%s".', $username), 0, $e);
		}

		Logger::getInstance()
			->log(" - MembreRepository::loadUserByUsername($username)" .
				"\n - classe: " . get_class($user) .
				"\n - toString: " . $user->toString());
		
		return $user;
	}
	
	public function loadUserBySalt($salt)
	{
		$em = $this	->getEntityManager();
		$q = $em->createQuery('
				SELECT m
		    	FROM DesignInitializrBundle:Membre m
				WHERE m.saltMembre = :salt
		')->setParameter('salt', $salt);
	
		try
		{
			$user = $q->getSingleResult();
		}
		catch (NoResultException $e)
		{
			throw new UsernameNotFoundException(sprintf('Unable to find an active user DesignInitializrBundle:User object identified by "%s".', $username), 0, $e);
		}

		Logger::getInstance()
			->log(" - MembreRepository::loadUserBySalt('$salt')" .
				"\n - classe: " . get_class($user) .
				"\n - toString: " . $user->toString());
		
		
		return $user;
	}

	public function refreshUser(UserInterface $user)
	{
		$class = get_class($user);
		
		Logger::getInstance()
			->log(" - MembreRepository::refreshUser(UserInterface '".$user->toString()."')" .
				"\n - classe: $class - salt:".$user->getSalt());
		
		if (!$this->supportsClass($class))
		{
			throw new UnsupportedUserException(
					sprintf(
							'Instances of "%s" are not supported.',
							$class
					)
			);
		}

		return $this->loadUserBySalt($user->getSalt());
		//return $this->find($user->getSalt());
		//return $this->loadUserByUsername($user->getUsername());
	}

	public function supportsClass($class)
	{
		return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
	}
	
	public function get_class()
	{
		return "Design\InitializrBundle\Entity\MembreRepository";
	}
}
?>