<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Uid\UuidV4;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('/homepage');
    }

    #[Route(path: '/forgot', name: 'app_forgot_password')]
    public function forgotPassword(
        Request $request, 
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        if ($request->isMethod('POST')) {
            $email = $request->get('_email');
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'No user found with this email');
                return $this->redirectToRoute('app_forgot_password');
            }

            $resetToken = new UuidV4();
            $user->setResetToken($resetToken);

            $entityManager->flush();

            $msg = (new TemplatedEmail())
                ->from('noreply@example.com')
                ->to($user->getEmail())
                ->subject('Password Reset Request')
                ->htmlTemplate('emails/reset.html.twig')
                ->context([
                    'resetToken' => $resetToken,
                    'userEmail' => $user->getEmail()
                ]);

            $mailer->send($msg);

            $this->addFlash('success', 'Password reset instructions sent to your email');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('forgot.html.twig');
    }

    #[Route(path: '/reset', name: 'app_reset_password')]
    public function resetPassword(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        ?string $token = null
    ): Response {
        if ($token) {
            $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);
            
            if (!$user) {
                $this->addFlash('error', 'Invalid reset token');
                return $this->redirectToRoute('app_login');
            }
    
            if ($request->isMethod('POST')) {
                $password = $request->get('password');
                $confirmPassword = $request->get('confirm_password');
    
                if ($password !== $confirmPassword) {
                    $this->addFlash('error', 'Passwords do not match');
                    return $this->redirectToRoute('app_reset_password', ['token' => $token]);
                }
    
                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
                $user->setResetToken(null);
                
                $entityManager->flush();
    
                $this->addFlash('success', 'Password successfully reset');
                return $this->redirectToRoute('app_login');
            }
    
            return $this->render('reset.html.twig', ['token' => $token]);
        }
    
        return $this->redirectToRoute('app_login');
    }
}
