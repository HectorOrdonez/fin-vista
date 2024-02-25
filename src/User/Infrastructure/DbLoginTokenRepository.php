<?php

namespace FinVista\User\Infrastructure;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbLoginTokenRepository implements LoginTokenRepositoryInterface
{
    public function create(LoginToken $token)
    {
        DB::insert('INSERT INTO login_tokens(user_id, token) VALUES(?, ?)', [
            $token->userId,
            $token->token,
        ]);

        $token->id = DB::getPdo()->lastInsertId();

        return $token->id;
    }

}
