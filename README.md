## Athrois: A PHP Message Bus

Athrois is a lightweight sample implementation in PHP of a centralized message bus, a variant of the Publish/Subscribe pattern.

### Name

Everything needs a name. Athrois is derived from Greek “ἄθροισις”, which means to collect. This implementation uses a pool to “collect” various different listeners.

### Structure

There is a central pool object of type ```Athrois\Pool```, which accepts listeners to register for events. Your listeners need to implement the ```Athrois\Listener``` interface (```notify()```); events need to implement the ```Athrois\Event``` interface (methodless).

### Status

Not intended for production use, this is an example. If you happen to find any real world use, let me know how it works out.

### Install via composer
	"require": {
	    …
        "drx777/athrois": "dev-master"
    },
    "repositories": [
	    {
			"type": "vcs",
			"url": "git://github.com/drx777/Athrois.git"
	    }
    ],

### Usage

see example/demo01.php …

