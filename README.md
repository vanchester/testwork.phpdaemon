# Test work

## Task

Create daemon on PHP for increment number for each data key.

Code must contains class

```
<?php
class Cmd {
    private $count = 0;
    public function getCount ()
    {
        return ++$this->count;
    }
}
```

For each HTTP-request '/cmdN' Daemon must create separate object of Cmd and call method getCount().

For example

```
# curl http://localhost/cmd1
1
# curl http://localhost/cmd1
2
# curl http://localhost/cmd1
3
# curl http://localhost/cmd2
1
```

## Requirements

* PHP >= 5.4
* Web-server (Apache, nginx etc.)

## File structure

* `public/index.php` - index script for HTTP-server.
* `Service/*.php` - classes with all logic.
* `daemon.php` - script for Daemon start.
* `config.example.php` - file with settings for Daemon and index script. Copy it to config.php.

## How to use

1. Clone repository or unpack tarball in some folder.
2. Copy `config.example.php` to `config.php` and change settings in `config.php` (optional).
3. Start Daemon with command `/path/to/php /path/to/daemon.php &`. 
You should see message `Daemon listening <host>:<port>` if success.
4. Configure virtual host in web-server to redirect all HTTP-request to file `public/index.php`.
5. Create HTTP-request to your domain, for example `http://your.domain/cmd1`.

## Remarks

* I chose the simplest way to realization the task (in code, in deployment and in usage).
* You can call `/path/to/php /path/to/public/index.php cmd1` from console and see the same result as by HTTP-request.
