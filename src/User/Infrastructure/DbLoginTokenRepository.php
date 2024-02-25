<?php

namespace FinVista\User\Infrastructure;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DbLoginTokenRepository implements LoginTokenRepositoryInterface
{
    public function create(LoginToken $token): int
    {
        DB::insert('INSERT INTO login_tokens(user_id, token) VALUES(?, ?)', [
            $token->userId,
            $token->token,
        ]);

        $token->id = DB::getPdo()->lastInsertId();

        return $token->id;
    }

    public function findByToken(string $token): LoginToken
    {
        $result = DB::selectOne('SELECT id, user_id, token FROM login_tokens WHERE token = ?', [$token]);

        if($result === null)
        {
            // @todo
//            UserNotFound::for($email);
        }

        $loginToken = new LoginToken();
        $loginToken->id = $result->id;
        $loginToken->userId = $result->user_id;
        $loginToken->token = $result->token;

        return $loginToken;
    }

    public function delete(LoginToken $token): void
    {
        DB::delete('DELETE FROM login_tokens WHERE token = ?', [$token->token]);
    }
}
