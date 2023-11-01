<?php

declare(strict_types=1);

namespace App\Controllers;
use App\Attributes\Get;
use App\Attributes\Post;
use App\Models\Email;
use App\View;
use Symfony\Component\Mime\Address;

class UserController
{
    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/register');
    }

    #[Post('/users')]
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ', $name)[0];

        $html = <<<BODY
        <h1>Hello $firstName,</h1>
        <p>Thank you for registering with us.</p>
        BODY;

        $text = <<<BODY
        Hello $firstName,
        Thank you for registering with us.
        BODY;

        (new Email())->queue(
            new Address($email),
            new Address('support@example.com', 'Support'),
            'Welcome: Thanks for registering!',
            $html,
            $text
        );
    }
}