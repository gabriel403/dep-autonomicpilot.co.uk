These are just some quick notes really, just for some future reference.

Invokables
===
No deps, can just be instantiated when needed, like controllers normally have no direct dependencies that are required during construction.

Factories
===
Dependent on other objects that need fetching before instantiating can occur, a factory can be a closure straight in the config (but this stops caching), in the module.php or as concrete classes implementing the FactoryInterface. 

The concrete class way is best when you're doing some fairly substancial work, you implement the createService method (which takes a servicelocatorinterface object), you retrieve other objects from the servicemanager (invokables or factories) and then return an instance or some object as a result.

And that's it!