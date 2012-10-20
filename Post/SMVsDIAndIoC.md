Quick notes for dependency injection vs service locator, this is mainly for zf2 but the basics apply elsewhere.

Inversion of Control
===
IoC is a way of getting modules or objects into the right class when they're needed, the instantiation of an object is abstracted away from the class requiring it, in a way that makes duck typing a practical reality.

Dependency Injection
===
Dependency injection relies on reflection to ascertain what objects are required for the construction of a particular object. Configuration is set up so that when the DI container is required to construct a certain object, it knows that it either needs to pass instances of certain other objects to the constructor or to call a 'set' function for that dependency. e.g. obj a requires obj b and obj c, the __construct function signature calls for an object of type b and there is a setC function whos signature calls for an object of type C.
Objects B and C may require further dependencies that can be configured to be injected as well.

This can be considered as an implicit way of injecting dependencies.

Service Locator
===
In a service locator we set a key in the sl to be an instance of an object, if the instance it's self has no dependencies that's the end, however if it does have dependencies then we use a factory or an invokable to pass the sl to an inteligent object that then gets further dependencies from the sl. e.g. obj a relies on obj b and obj c, we pass a factory to the sl as the way of instantiating a, in this factory the sl is passed into it and the factory uses the sl to retrieve instances of obj b and obj c which are used to construct obj a and the new instance of obj a is returned.

This can be considered an explicit way of injecting dependencies.

DI vs SL
===

DI is a bit easier to set up, as it just requires a lot of writing configs, it's also less magical as all the deps for a class are in front of your face in the config files, but it does require a lot of reflection (which may be cacheable) to work out how to get the dep into the class, this can be costly on reources in large classes. 
On the other hand SL uses individual closures or factories to retrieve the deps for instantiating the service requested, and these deps could need further factories for further deps etc requiring a further coder to peice through more and more classes(factories or closures) to understand all the deps being used but you get the service when you need, if in some circumstances you don't need the dep you don't ask for it and you save some resources, with DI you will always have all deps in place, whether you use them or not. 
Also as DI is configured as deps for a class, if multiple places require the same dep you'd have to configure each, whereas with SL you'd just ask for it and it'd already be available without extra configuration.

