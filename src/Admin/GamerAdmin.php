<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Symfony\Component\Filesystem\Filesystem;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Gamer;

class GamerAdmin extends AbstractAdmin {

    /**
     * 
     * @param type $code
     * @param type $class
     * @param type $baseControllerName
     */
    public function __construct($code, $class, $baseControllerName) {
        parent::__construct($code, $class, $baseControllerName);
        $this->setUniqid('gameradmin');
    }

    /**
     * Configure Form Fields for Sonata Form
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $gamer = $this->getSubject();

        $formMapper->add('account', TextType::class, [
            'required' => true]
        );

        // Show image save in Entity
        $imageFieldOptions = ['required' => false];
        if ($gamer && ($webPath = $gamer->getImagePath())) {
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request_stack')->getCurrentRequest()->getBasePath() . '/' . $webPath;
            $imageFieldOptions['help'] = '<img src="' . $fullPath . '" class="admin-preview"/>';
        }
        $formMapper->add('image', FileType::class, $imageFieldOptions);

        $formMapper->add('name', TextType::class, [
            'required' => true]
        );
        $formMapper->add('bio', TextType::class, [
            'required' => true]
        );
        $formMapper->add('country', CountryType::class, [
            'required' => true]
        );
        $formMapper->add('server', TextType::class, [
            'required' => true]
        );
        $formMapper->add('game', ModelListType::class, [
            'btn_delete' => false]
        );
        $formMapper->add('twitch', TextType::class, [
            'required' => false]
        );
        $formMapper->add('youtube', TextType::class, [
            'required' => false]
        );
        $formMapper->add('position', IntegerType::class, [
            'required' => true]
        );
    }

    /**
     * Configure Filters
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('account');
        $datagridMapper->add('name');
        $datagridMapper->add('country');
    }

    /**
     * Configure List Columns
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('id');
        $listMapper->add('account');
        $listMapper->add('name');
        $listMapper->add('country');
        $listMapper->add('position');
        $listMapper->add('game.name');
    }

    /**
     * Define Exports Columns
     * @return array
     */
    public function getExportFields() {
        return [
            'id' => 'id',
            'account' => 'account',
            'name' => 'name',
            'bio' => 'bio',
            'country' => 'country',
            'server' => 'server',
            'position' => 'position',
            'game' => 'game.abbreviation',
            'twitch' => 'twitch',
            'youtube' => 'youtube'
        ];
    }

    /**
     * Function execute pre Persist Entity
     * @param Game $gamer
     */
    public function prePersist($gamer) {
        $fileSystem = new Filesystem();
        $fileSystem->remove(sys_get_temp_dir() . '/topgamersapi/cache');
        $gamer->upload();
    }

    /**
     * Function execute pre Update Entity
     * @param Game $gamer
     */
    public function preUpdate($gamer) {
        $fileSystem = new Filesystem();
        $fileSystem->remove(sys_get_temp_dir() . '/topgamersapi/cache');
        $gamer->upload();
    }

    /**
     * To String
     * @param Gamer $object
     * @return string
     */
    public function toString($object) {
        return $object instanceof Gamer ? 'Gamer: [' . $object->getId() . '] ' . $object->getName() : 'Gamer';
    }

}
