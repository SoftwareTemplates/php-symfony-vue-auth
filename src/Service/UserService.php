<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\NotAuthorizedException;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use App\Security\UserVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class UserService
{

    private UserRepository $userRepository;
    private Security $security;
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        UserRepository $userRepository,
        Security $security,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $hasher
    ) {
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->hasher = $hasher;
    }

    /**
     * Creates a new user in the system and adds all requested permission groups to it
     *
     * @param string $username The username of the new user
     * @param string $password The password of the new user
     * @return User The new user
     * @throws NotAuthorizedException If the user is not authorized
     */
    public function createNewUser(string $username, string $password, array $roles): User
    {
        if ($this->security->isGranted(UserVoter::CREATE_USER)) {
            $usr = (new User())
                ->setUsername($username);
            $usr->setPassword($this->hasher->hashPassword($usr, $password));
            if (in_array(User::ROLE_ADMIN, $roles) && !$this->security->isGranted(User::ROLE_ADMIN)) {
                throw new NotAuthorizedException('You are not authorized for this action');
            }
            foreach ($roles as $role) {
                $usr->addRole($role);
            }
            $this->entityManager->persist($usr);
            $this->entityManager->flush();
            return $usr;
        } else {
            throw new NotAuthorizedException('You are not authorized for this action');
        }
    }

    /**
     * Deletes a user from the inventory system.
     *
     * @param int $userID The ID of the user that should be removed
     * @throws NotAuthorizedException If the user is not authorized to delete a user
     * @throws UserNotFoundException If the user that should be deleted does not exist
     */
    public function deleteUser(int $userID): void
    {
        if ($this->security->isGranted(UserVoter::DELETE_USER)) {
            $user = $this->userRepository->findOneBy(['id' => $userID]);
            if ($user === null) {
                throw new UserNotFoundException('The user has not been found in the system');
            }
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        } else {
            throw new NotAuthorizedException('You are not authorized for this action');
        }
    }

    /**
     * Returns all users in the system if the user is authorized.
     *
     * @return array All users in the system
     * @throws NotAuthorizedException If the user is not authorized
     */
    public function getAllUsers(): array
    {
        if (!$this->security->isGranted(UserVoter::VIEW_USERS)) {
            throw new NotAuthorizedException('You are not authorized for this action');
        }
        return $this->userRepository->findAll();
    }

    /**
     * Updates an user in the database.
     *
     * @param int $id The ID of the user that should be updated
     * @param string $username The new username of the user
     * @param array $roles All roles the user should have
     * @return User The updated user.
     * @throws NotAuthorizedException If the user cannot update an user
     * @throws UserNotFoundException If the user does not exist
     */
    public function updateUser(
        int $id,
        string $username,
        array $roles
    ): User {
        if (!$this->security->isGranted(UserVoter::UPDATE_USER)) {
            throw new NotAuthorizedException('You are not authorized');
        }
        $user = $this->userRepository->findOneBy(['id' => $id]);
        if (null === $user) {
            throw new UserNotFoundException('The user does not exist in the system.');
        }
        $user->setUsername($username);
        foreach($user->getRoles() as $role) {
            $user->removeRole($role);
        }
        foreach($roles as $role) {
            $user->addRole($role);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

}