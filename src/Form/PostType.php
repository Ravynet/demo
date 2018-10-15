<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PostType extends AbstractType
{
    private $user;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->user = $storage->getToken()->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Post Title'])
            ->add('description', TextAreaType::class)
            ->add('date', DateType::class, ['format' => 'yyyy-MM-dd HH:mm:ss', 'widget' => 'single_text'])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'empty_data' => $this->user,
                'choice_label' => 'username'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return null;
    }
}
