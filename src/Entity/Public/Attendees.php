<?php

    namespace App\Entity\Public;

    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity]
    class Attendees
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[ORM\Column]
        private ?string $lastName = null;

        #[ORM\Column]
        private ?string $firstName = null;

        #[ORM\Column(unique: true)]
        private ?string $email = null;

        #[ORM\Column(unique: true)]
        private ?string $phone = null;

        #[ORM\Column(nullable: true)]
        private ?bool $newsletter = null;



        //setters
        public function setLastName(?string $lastName): void
        {
            $this->lastName = $lastName;
        }

        public function setPhone(?string $phone): void
        {
            $this->phone = $phone;
        }

        public function setEmail(?string $email): void
        {
            $this->email = $email;
        }

        public function setFirstName(?string $firstName): void
        {
            $this->firstName = $firstName;
        }

        public function setNewsletter(?bool $newsletter): void
        {
            $this->newsletter = $newsletter;
        }



        //getters
        public function getPhone(): ?string
        {
            return $this->phone;
        }

        public function getEmail(): ?string
        {
            return $this->email;
        }

        public function getLastName(): ?string
        {
            return $this->lastName;
        }

        public function getFirstName(): ?string
        {
            return $this->firstName;
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getNewsletter(): ?bool
        {
            return $this->newsletter;
        }
    }