ZF2 Annotated Forms and ComposedObject
=======================

So you're using the data mapper pattern, just for awesomeness. You're also using annotated entities being parsed into forms, since in most cases your entities are in a one to one relationship with your forms.

However you do occasionally need forms that are made up of multiple entities.

you could create a new entity with all the bits in and then parse them into seperate entities for persisting.

However it's easier to create a new entity using multiple @Annotation/ComposedObject annotations, this gives us unified validation and can get the seperate entities easily from the outer entity.

Here we have the factory for creating the form.  
Form Factory:  
~~~ {.language-php .prettyprint .linenums}
'WelcomeMessageForm' => function ($sm) {

    $msg = new Model\WelcomeMessage;

    $fc =  new Model\LicenceContent;
    $msg->setFutureMessage($fc);

    $cc =  new Model\LicenceContent;
    $msg->setCurrentMessage($cc);

    $builder = new \Zend\Form\Annotation\AnnotationBuilder;
    $form = $builder->createForm($msg);
    $form->bind($msg);
    
    $form->get('current_message')->setObject(new Model\LicenceContent);
    $form->get('future_message')->setObject(new Model\LicenceContent);
    return $form;
},
~~~
When using ComposedObject, the composed objects are parsed into fieldsets within the form.  
By doing the setObject calls on the fieldsets in the factory, this allows the form to iterate through the composed objects in a 'populated' main entity to populate values in the form.


WelcomeMessage Entity:
~~~ {.language-php .prettyprint .linenums}
namespace Module\Model;
use Zend\Form\Annotation;
/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class WelcomeMessage
{

    /**
     * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
     * @Annotation\ComposedObject("Module\Model\LicenceContent")
     */
    protected $current_message;

    /**
     * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
     * @Annotation\ComposedObject("Module\Model\LicenceContent")
     */
    protected $future_message;

    public function getCurrentMessage()
    {
        return $this->current_message;
    }

    public function setCurrentMessage($currentMessage)
    {
        $this->current_message = $currentMessage;
        return $this;
    }

    public function getFutureMessage()
    {
        return $this->future_message;
    }

    public function setFutureMessage($futureMessage)
    {
        $this->future_message = $futureMessage;
        return $this;
    }

}
~~~
Here we have a simple 'super' entity composed of 2 other objects (in this example, both the same type).



Controller Action:
~~~ {.language-php .prettyprint .linenums}
public function welcomeAction()
{
    //get id from session
    $licence_id = $this->zfcUserAuthentication()->getIdentity()->getId();
    $viewModel = new ViewModel();
    $form      = $this->getCustomiseService()->getWelcomeMessageForm();
    if ($this->getRequest()->isPost()) {
        $data = $this->params()->fromPost();
        $form->setData($data);
        if ($form->isValid()) {
            /* @var $entity \Module\Model\WelcomeMessage */
            $entity = $form->getData();

            /* @var $curMsg \Module\Model\LicenceContent */
            $curMsg = $entity->getCurrentMessage();

            /* @var $ftrMsg \Module\Model\LicenceContent */
            $ftrMsg = $entity->getFutureMessage();

            $this->getCustomiseService()->updateWelcomeMessage($licence_id, $curMsg, $ftrMsg);

        }
    }
    $form->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
    $entity = $this->getCustomiseService()->getWelcomeMessage($licence_id);
    $form->bind($entity);
    $viewModel->setVariable('form', $form);
    return $viewModel;
}
~~~
Here we have a simple action for validating and saving a form, and for also fetching a 'populated' entity from the db.

And that's it, we have a main object made out of 2 composed objects, the 2 composed objects are parsed into fieldsets in the main form. You can retrieve and set/populate the values of the composed objects easily.