<?php

namespace MicroStore\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use MicroStore\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a list of all users, sorted by role and name.
     *
     * @return array A list of all users.
     */
    public function findAll() {
        $sql = "select * from membre order by pseudoMembre";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $entities = array();
        foreach ($result as $row) {
            $username = $row['pseudoMembre'];
            $entities[$username] = $this->buildDomainObject($row);
        }
        return $entities;
    }

    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \MicroStore\Domain\User|throws an exception if no matching user is found
     */
    public function find($username) {
        $sql = "select * from membre where pseudoMembre=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            return false;
    }

    /**
     * Saves a user into the database.
     *
     * @param \MicroStore\Domain\User $user The user to save
     */
    public function save(User $user) {
        $userData = array(
            'pseudoMembre' => $user->getUsername(),
            'mdpMembre' => $user->getPassword(),
            'mailMembre' => $user->getMail(),
            'nomMembre' => $user->getNom(),
            'prenomMembre' => $user->getPrenom(),
            'adresseMembre' => $user->getAdresse(),
            'villeMembre' => $user->getVille(),
            'CPMembre' => $user->getCodePostal(),
            'salt' => $user->getSalt(),
            'niveauMembre' => 'ROLE_USER'
            );

        if ($user->getId()) {
            // The user has already been saved : update it
            $this->getDb()->update('membre', $userData, array('idMembre' => $user->getId()));
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('membre', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
    }

    /**
     * Removes an user from the database.
     *
     * @param integer $id The user id.
     */
   /* public function delete($id) {
        // Delete the user
        $this->getDb()->delete('t_user', array('usr_id' => $id));
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from membre where pseudoMembre=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'MicroStore\Domain\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \MicroStore\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setId($row['idMembre']);
        $user->setUsername($row['pseudoMembre']);
        $user->setPassword($row['mdpMembre']);
        $user->setSalt($row['salt']);
        $user->setRole($row['niveauMembre']);
        $user->setMail($row['mailMembre']);
        $user->setNom($row['nomMembre']);
        $user->setPrenom($row['prenomMembre']);
        $user->setAdresse($row['adresseMembre']);
        $user->setVille($row['villeMembre']);
        $user->setCodePostal($row['CPMembre']);
        $user->setRole($row['niveauMembre']);
        return $user;
    }
}