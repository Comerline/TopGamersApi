<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Symfony\Component\Filesystem\Filesystem;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Game;

class GameAdmin extends AbstractAdmin {

    /**
     * 
     * @param type $code
     * @param type $class
     * @param type $baseControllerName
     */
    public function __construct($code, $class, $baseControllerName) {
        parent::__construct($code, $class, $baseControllerName);
        $this->setUniqid('gameadmin');
    }
    
    /**
     * Configure Form Fields for Sonata Form
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $game = $this->getSubject();

        // Show image save in Entity
        $imageFieldOptions = ['required' => false];
        if ($game && ($webPath = $game->getImagePath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath() . '/' . $webPath;
            $imageFieldOptions['help'] = '<img src="' . $fullPath . '" class="admin-preview"/>';
        }
        $formMapper->add('image', FileType::class, $imageFieldOptions);

        $formMapper->add('abbreviation', TextType::class, [
            'required' => true]
        );
        $formMapper->add('name', TextType::class, [
            'required' => true]
        );
    }

    /**
     * Configure Filters
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('abbreviation');
        $datagridMapper->add('name');
    }

    /**
     * Configure List Columns
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('id');
        $listMapper->add('abbreviation');
        $listMapper->add('name');
    }

    /**
     * Function execute pre Persist Entity
     * @param Game $game
     */
    public function prePersist($game) {
        $fileSystem = new Filesystem();
        $fileSystem->remove(sys_get_temp_dir() . '/topgamersapi/cache');
        $game->upload();
    }

    /**
     * Function execute pre Update Entity
     * @param Game $game
     */
    public function preUpdate($game) {
        $fileSystem = new Filesystem();
        $fileSystem->remove(sys_get_temp_dir() . '/topgamersapi/cache');
        $game->upload();
    }

    /**
     * to String
     * @param Game $object
     * @return string
     */
    public function toString($object) {
        return $object instanceof Game ? 'Game: [' . $object->getId() . '] ' . $object->getName() : 'Game';
    }

}
