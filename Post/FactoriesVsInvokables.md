These are just some quick notes really, just for some future reference, mostly concerned with the differences as they pertain to invokables and factories in Zend/ServiceManager.

##Invokables

An invokable is simply a class that can be instantiated, it doesn't normally require any deps and can just be instantiated when needed, like controllers normally have no dependencies that are required during construction nor any deps required after construction and before the object can start work, even if they're set via setters.

##Factories

If your dependency is dependent on other objects that need fetching before the object will work properly, even if these are set via setters rather than during construction and inteligent object, in this case a factory, is the way to go. A factory can be a closure straight in the config (but this stops caching), in the module.php or as concrete classes. These classes are either invokable via __invoke or implement the FactoryInterface. 

####Closure:
~~~
    'service_manager' => array(
        'factories' => array(
            'something' => function ($sm) {
            	$se = $sm->get('somethingelse');
            	$s = new Something($se);
            	return $s;
            },
        ),
    ),
~~~

####Factory object
~~~
    'service_manager' => array(
        'factories' => array(
            'something' => 'SomethingFactory',
        ),
    ),

class SomethingFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
       	$se = $sm->get('somethingelse');
       	$s = new Something($se);
       	return $s;
    }
}
~~~
####Invokable factory
~~~
    'service_manager' => array(
        'invokables' => array(
            'something' => 'SomethingFactoryInvokable',
        ),
    ),


class Something
{
    public function __invoke(ServiceLocatorInterface $sm)
    {
       	$se = $sm->get('somethingelse');
       	$s = new Something($se);
       	return $s;
    }
}
~~~






The concrete class way is best when you're doing some fairly substantial work.
You can either implement the FactoryInterface and then the createService method (which takes a servicelocatorinterface object) or just make the class invokable by implementing __invoke (which also takes the sm in). You can then retrieve other objects from the servicemanager (invokables or factories) and then return an instance of some object, of a singluar type per factory, as a result.

And that's it!