<?php

    namespace App\Form\Fields\Public;

    use Symfony\Component\Validator\Constraints as Assert;

    class AttendeesRegistrationFields
    {
        #[Assert\NotBlank]
        #[Assert\Length(
            min: 3,
            max: 25,
            minMessage: 'Ce nom de famille est trop court, minimum 3 caractères',
            maxMessage: 'Ce nom de famille est trop long, maximum 25 caractères'
        )]
        #[Assert\Regex(
            pattern: '#^[a-zA-Z]+$#',
            message: 'Format incorrect, votre nom de famille doit être sous la forme: jhon, JHON, ou Jhon'
        )]
        private ?string $lastName = null;

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 3,
            max: 30,
            minMessage: 'Prénoms trop court, minimum 3 caractères',
            maxMessage: 'Prénoms trop long, maximum 30 caractères',
        )]
        #[Assert\Regex(
            pattern: '#^[a-zA-Z\s]+$#',
            message: 'Format incorrect, vos prénoms doivent contenir des lettres uniquement'
        )]
        private ?string $firstName = null;

        #[Assert\Email(message: 'Cet adresse email n\'est pas valide')]
        #[Assert\NotBlank]
        #[Assert\Regex(
            pattern: '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',
            message: 'Votre email doit être sous la forme: xyz@exemple.com'
        )]
        private ?string $email = null;

        #[Assert\Regex(
            pattern: '#^(?:0[157](?:[ -]?[0-9]{2}){4})$#',
            message: 'Entrez un numéro de téléphone ivoirien; Ex : 01 02 03 04 05'
        )]
        private ?string $phone = null;


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

        public function getNewsletter(): ?bool
        {
            return $this->newsletter;
        }
    }