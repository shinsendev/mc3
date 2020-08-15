<?php

namespace App\Security\Voter;

use App\Component\Error\Mc3Error;
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
        if (gettype($token->getUser()) === 'string') {
            throw new Mc3Error('User is not logged anymore, you must login again.');
        }

        if ($token->getUser()->getActive()) {
            return true;
        }

        return false;
    }
}
