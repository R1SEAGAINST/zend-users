<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;


class User 
{
    // User status constants.
    const STATUS_ACTIVE       = 1; // Active user.
    const STATUS_RETIRED      = 2; // Retired user.
    

    protected $id;


    protected $email;
    

    protected $fullName;


    protected $password;


    protected $status;
    

    protected $dateCreated;

    protected $passwordResetToken;
    

    protected $passwordResetTokenCreationDate;
    

    public function getId() 
    {
        return $this->id;
    }


    public function setId($id) 
    {
        $this->id = $id;
    }


    public function getEmail() 
    {
        return $this->email;
    }


    public function setEmail($email) 
    {
        $this->email = $email;
    }
    

    public function getFullName() 
    {
        return $this->fullName;
    }       


    public function setFullName($fullName) 
    {
        $this->fullName = $fullName;
    }
    

    public function getStatus() 
    {
        return $this->status;
    }


    public static function getStatusList() 
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_RETIRED => 'Retired'
        ];
    }    
    

    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];
        
        return 'Unknown';
    }    
    

    public function setStatus($status) 
    {
        $this->status = $status;
    }   
    

    public function getPassword() 
    {
       return $this->password; 
    }
    

    public function setPassword($password) 
    {
        $this->password = $password;
    }
    

    public function getDateCreated() 
    {
        return $this->dateCreated;
    }
    

    public function setDateCreated($dateCreated) 
    {
        $this->dateCreated = $dateCreated;
    }    
    

    public function getResetPasswordToken()
    {
        return $this->passwordResetToken;
    }
    

    public function setPasswordResetToken($token) 
    {
        $this->passwordResetToken = $token;
    }

    public function getPasswordResetTokenCreationDate()
    {
        return $this->passwordResetTokenCreationDate;
    }
    

    public function setPasswordResetTokenCreationDate($date) 
    {
        $this->passwordResetTokenCreationDate = $date;
    }
}



