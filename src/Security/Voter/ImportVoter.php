<?php

namespace App\Security\Voter;

use App\Component\Authentication\Authentication;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ImportVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['IMPORT_CREATE', 'IMPORT_UPDATE', 'IMPORT_READ']);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        dd($user);

        Authentication::checkRefreshToken(Authentication::createFirebaseAuth(), $subject['accessKey']);
        // todo: check more about the user?

        return true;
    }
}
