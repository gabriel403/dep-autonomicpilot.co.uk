These are just some quick notes really, just for some future reference.

Invokables
===
No deps, can just be instantiated when needed, like controllers normally have no dependencies that are required during construction or required before the object can work properly, even if set via setters.

Factories
===
Dependent on other objects that need fetching before the object will work properly, even if these are set via setters rather than during construction. A factory can be a closure straight in the config (but this stops caching), in the module.php or as concrete classes. These classes are either invokable via __invoke or implement the FactoryInterface. 

The concrete class way is best when you're doing some fairly substancial work.
You can either implement the FactoryInterface and then the createService method (which takes a servicelocatorinterface object) or just make the class invokable by implementing __invoke (which also takes the sm in). You can then retrieve other objects from the servicemanager (invokables or factories) and then return an instance of some object, of a singluar type per factory, as a result.

And that's it!