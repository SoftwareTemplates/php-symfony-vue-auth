<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

/**
 * The general voter for user actions
 */
class UserVoter extends Voter
{
    public const CREATE_USER = 'CREATE_USER';
    public const DELETE_USER = 'DELETE_USER';
    public const VIEW_USERS = 'VIEW_USERS';
    public const UPDATE_USER = 'UPDATE_USER';

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject = null): bool
    {
        if (!in_array($attribute, [
            self::CREATE_USER,
            self::DELETE_USER,
            self::VIEW_USERS,
            self::UPDATE_USER
        ])) {
            return false;
        }
        if ($subject !== null && !$subject instanceof User) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $loggedInUser = $this->security->getUser();

        if (!$loggedInUser instanceof User) {
            // User must be logged in
            return false;
        }

        return match ($attribute) {
            self::CREATE_USER, self::DELETE_USER, self::UPDATE_USER => $this->canUpdateUserOnHighLevel(),
            self::VIEW_USERS => $this->userIsAllowedToViewUser(),
            default => false,
        };
    }

    /**
     * Checks if the user has elevated rights to create users or groups.
     *
     * @return bool If the user has the permission
     */
    private function canUpdateUserOnHighLevel(): bool
    {
        return $this->security->isGranted(User::ROLE_MANAGER)
            || $this->security->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Checks if the user is allowed to view other users
     *
     * @return bool If the user is allowed to view users
     */
    private function userIsAllowedToViewUser(): bool
    {
        return $this->security->isGranted(User::ROLE_USER);
    }
}