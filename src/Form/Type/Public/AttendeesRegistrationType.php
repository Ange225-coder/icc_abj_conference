<?php

    namespace App\Form\Type\Public;

    use Symfony\Component\Form\AbstractType;
    use App\Form\Fields\Public\AttendeesRegistrationFields;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class AttendeesRegistrationType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('lastName', TextType::class, [
                    'label' => 'Nom'
                ])

                ->add('firstName', TextType::class, [
                    'label' => 'Prénoms'
                ])

                ->add('email', EmailType::class, [
                    'label' => 'e-mail'
                ])

                ->add('phone', TelType::class, [
                    'label' => 'Contact téléphonique'
                ])

                ->add('newsletter', CheckboxType::class, [
                    'required' => false,
                ])
            ;
        }



        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => AttendeesRegistrationFields::class,
            ]);
        }
    }