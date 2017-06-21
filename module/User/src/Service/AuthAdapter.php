<?php
namespace User\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use User\Entity\User;


class AuthAdapter implements AdapterInterface
{


    private $email;
    

    private $password;
    

    private $entityManager;
        

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    

    public function setEmail($email) 
    {
        $this->email = $email;        
    }
    

    public function setPassword($password) 
    {
        $this->password = (string)$password;        
    }
    

    public function authenticate()
    {                

        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($this->email);
        

        if ($user == null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND, 
                null, 
                ['Invalid credentials.']);        
        }   
        

        if ($user->getStatus()==User::STATUS_RETIRED) {
            return new Result(
                Result::FAILURE, 
                null, 
                ['User is retired.']);        
        }
        

        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        
        if ($bcrypt->verify($this->password, $passwordHash)) {

            return new Result(
                    Result::SUCCESS, 
                    $this->email, 
                    ['Authenticated successfully.']);        
        }             
        

        return new Result(
                Result::FAILURE_CREDENTIAL_INVALID, 
                null, 
                ['Invalid credentials.']);        
    }
}


