<?php

/**
 * iParcel
 * Copyright (c) 2023 Rafael Galvan
 * Copyright (c) 2023 Sonny Jahanara
 * Copyright (c) 2023 Brandon Won
 * Copyright (c) 2023 Jason Mullen
 * 
 * Code released under the MIT License.
 */

declare(strict_types=1);

class loginHandler
{
    protected $db;

    protected $email;

    protected $password;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function validate_request_input(array $request_input): bool
    {
        if (empty($request_input['email']) || empty($request_input['password'])) {
            return false;
        }

        return true;
    }

    public function set_login_creds(array $request_input)
    {
        $this->email = $request_input['email'];
        $this->password = $request_input['password'];
    }

    public function do_login(): bool
    {
        $stmt = $this->db->prepare("SELECT user_id,email,password FROM users WHERE email= :email");
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            return false;
        }
        $user = $stmt->fetch();
        if (!password_verify($this->password, $user)) {
            return false;
        }

        return true;
    }

    protected function verify_password(string $password, array $user): bool
    {
        return password_verify($password, $user["password"]);
    }
}
