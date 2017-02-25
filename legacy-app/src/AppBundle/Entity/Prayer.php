<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prayers")
 */
class Prayer
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $messageId;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $subject;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime", length=100)
     */
    protected $receivedOn;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set messageId
     *
     * @param integer $messageId
     *
     * @return Prayer
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * Get messageId
     *
     * @return integer
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Prayer
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Prayer
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Prayer
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set receivedOn
     *
     * @param string $receivedOn
     *
     * @return Prayer
     */
    public function setReceivedOn($receivedOn)
    {
        $this->receivedOn = $receivedOn;

        return $this;
    }

    /**
     * Get receivedOn
     *
     * @return string
     */
    public function getReceivedOn()
    {
        return $this->receivedOn;
    }
}
