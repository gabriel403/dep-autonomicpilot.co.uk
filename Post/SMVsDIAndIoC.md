Quick notes for dependency injection vs service locator, this is mainly for zf2 but the basics apply elsewhere.

##Inversion of Control {#smvdiioc-ioc}

IoC is a way of getting modules or objects into the right class when they're needed, the instantiation of an object is abstracted away from the class requiring it, in a way that makes duck typing a practical reality.

##Dependency Injection {#smvdiioc-di}


DI is, in it's most basic form, the process of inserting dependencies(obj b and c) into the object requiring them(obj a) without that object(obj a) needing to know how it happened.
~~~~~~~~~~~~~~~~~~~~~ {.language-php .prettyprint .linenums}
$a = new A(new B);	//constructor injection
$a->setC(new C);	//setter injection

class A
{
	public __contructor(B $b) {
		$this->b = $b;
	}

	public setC(C $c) {
		$this->c = $c;
	}
}

~~~~~~~~~~~~~~~~~~~~~

In ZF2, the dependency injection is implemented as a depenedency injection container, Zend/Di, it relies on reflection to ascertain what objects are required for the construction of a particular object. Configuration is set up so that when Zend/Di is required to construct a certain object, it knows that it either needs to pass instances of certain other objects to the constructor or to call a 'set' function for that dependency. e.g. obj a requires obj b and obj c, the __construct function signature calls for an object of type b and there is a setC function whos signature calls for an object of type C.
Objects B and C may require further dependencies that can be configured to be injected as well.


This can be considered as an implicit way of injecting dependencies.

##Service Locator {#smvdiioc-sl}


SL is in essence a way for the object(obj a) to get it's own dependencies without having to rely on an external source to set them for it. Rather than instantiating them itself an SL is injected into the object(obj a) and that is used to fetch the dependencies.

####Classic Service Loctor {#smvdiioc-sl}
~~~~~~~~~~~~~~~~~~~~~ {.language-php .prettyprint .linenums}
class A
{
	public __construct(ServiceLocator $sl) {
		$this->sl = $sl;
	}

	public getC() {
		if ( !is_set($this->c) ) {
			$this->c = $this->sl->get('c');
		}
		return $this->c;
	}
	public getB() {
		if ( !is_set($this->b) ) {
			$this->b = $this->sl->get('b');
		}
		return $this->b;
	}
}

~~~~~~~~~~~~~~~~~~~~~



In ZF2, we use the Zend/ServiceManager(SM) as an implementation of the service locator pattern, in the SM we set a key to be an instance of an object, if the object being constructed itself has no dependencies that's the end, however if it does have dependencies then we use a factory or an invokable to pass the sm to an inteligent object that then gets further dependencies from the SM. e.g. obj a relies on obj b and obj c, we pass a factory to the SM as the way of instantiating a, in this factory the sl is passed into it and the factory uses the sl to retrieve instances of obj b and obj c which are used to construct obj a and the new instance of obj a is returned.

####SM Invokable {#smvdiioc-slinvoke}
~~~~~~~~~~~~~~~~~~~~~ {.language-php .prettyprint .linenums}
class A
{
	public function __invoke(ServiceManager $sm) {
		$b = $sm->get('b');
		$c = $sm->get('c');
		$a = new A($b);
		$a->setC($c);
		return $a;
	}
}
~~~~~~~~~~~~~~~~~~~~~


This can be considered an explicit way of injecting dependencies.

DI vs SL
===

Di is a bit easier to set up, as it just requires a lot of writing configs, it's also less magical as all the deps for a class are in front of your face in the config files, however Zend\Di is a lot more magical than the classical version of it, as it does require a lot of reflection (which may be cacheable) to work out how to get the dep into the class, this can be costly on resources in large classes.

On the other hand Zend/ServiceManager uses individual closures or factories to retrieve the deps for instantiating the service requested, and these deps could need further factories for further deps etc requiring a further coder to piece through more and more classes(factories or closures) to understand all the deps being used but you get the service when you need, if in some circumstances you don't need the dep you don't ask for it and you save some resources, with DI you will always have all deps in place, whether you use them or not.

Also as DI is configured as deps for a class, if multiple places require the same dep you'd have to configure each, whereas with SL you'd just ask for it and it'd already be available without extra configuration.
