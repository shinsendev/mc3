<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ActivatedUserVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['ACTIVATED_USER']);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if ($token->getUser()->getActive()) {
            return true;
        }

        return false;
    }
}
