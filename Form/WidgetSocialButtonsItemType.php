<?php
namespace Victoire\Widget\SocialButtonsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author Paul Andrieux
 *
 */
class WidgetSocialButtonsItemType extends AbstractType
{
    protected $entity_name;
    protected $namespace;
    protected $widget;

    /**
     * Constructor
     *
     * @param string $entity_name
     * @param string $namespace
     * @param string $widget
     */
    public function __construct($entity_name, $namespace, $widget)
    {
        $this->namespace   = $namespace;
        $this->entity_name = $entity_name;
        $this->widget      = $widget;
    }

    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //choose form mode
        if ($this->entity_name === null) {
            //if no entity is given, we generate the static form
            $builder
                ->add('title', null, array(
                    'label' => "form.listing.socialButtons.title.label"))
                ->add('url', null, array(
                    'label' => "form.listing.socialButtons.url.label"))
                ->add('kind', 'choice', array(
                    'label'   => "form.listing.socialButtons.kind.label",
                    'choices' => array(
                        "blog"      => "Blog",
                        "email"     => "Email",
                        "facebook"  => "Facebook",
                        "flickr"    => "Flickr",
                        "github"    => "Github",
                        "gplus"     => "Google Plus",
                        "instagram" => "Instagram",
                        "linkedin"  => "Linkedin",
                        "location"  => "Localisation",
                        "pinterest" => "Pinterest",
                        "rss"       => "Flux rss",
                        "tel"       => "Téléphone",
                        "tumblr"    => "Tumblr",
                        "twitter"   => "Twitter",
                        "viadeo"    => "Viadeo",
                        "vimeo"     => "Vimeo",
                        "website"   => "Site web",
                        "youtube"   => "YouTube",
                        )))
                ->add('analyticsTrackCode', null, array(
                'label'          => 'form.link_type.analyticsTrackCode.label',
                'required'       => false,
                'attr'           => array(
                    'placeholder' => 'form.link_type.analyticsTrackCode.placeholder',
                )
            ));
        } else {
            //else, Type class will embed a EntityProxyType for given entity
            $builder
                ->add('position')
                ->add('entity', 'entity_proxy', array(
                    "entity_name" => $this->entity_name,
                    "namespace"   => $this->namespace,
                    "widget"      => $this->widget
            ));
        }
    }

    /**
     * bind form to WidgetSocialButtonsItem entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\SocialButtonsBundle\Entity\WidgetSocialButtonsItem',
            'widget'             => null,
            'translation_domain' => 'victoire'
        ));
    }

    /**
     * get form name
     *
     * @return string The name of the form
     */
    public function getName()
    {
        return 'socialbuttons_items';
    }
}
