<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{   
    /**
     * Get the default setup of a row
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration('Titre', 'Tappez un titre pour votre annonce'))
            ->add('slug', TextType::class, $this->getConfiguration('Adresse Web', 'Tappez l\'adresse web (automatique)'))
            ->add('coverImage', UrlType::class, $this->getConfiguration('URL de l\'image principal', 'Donnez l\'adresse d\'une image qui donne vraiment envie'))
            ->add('description', TextType::class, $this->getConfiguration('Description', 'Donnez une courte description'))
            ->add('about', TextareaType::class, $this->getConfiguration('Description détaillée', 'Tapez une description qui donne envie de venir chez vous'))
            ->add('rooms', IntegerType::class, $this->getConfiguration('Nombre de chambres', 'Le nombre de chambres disponibles'))
            ->add('price', MoneyType::class, $this->getConfiguration('Prix', 'Indiquer le prix pour une nuit'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
