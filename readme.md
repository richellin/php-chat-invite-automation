# php-chat-invite-automation
+ Slack invite automation

### Use
[Laravel5 : laravel-slack-invite-automation](https://github.com/richellin/laravel-slack-invite-automation)

### Composer
```sh
#composer.json
{
    "require": {
        "richellin/php-chat-invite-automation": "0.0.*"
    }
}

#install
composer install

```

### PHP
```php
<?php
require 'vendor/autoload.php';
use \richellin\chat\Invite;
use \richellin\chat\Channel\Slack;
$invite = new Invite();
$res = $invite->channel(new Slack())
              ->set([
                'team_name'=> 'Your team name',
                'email'=> 'Email',
                'channel'=> 'Channel',
                'token'=> 'xoxp-token'
                ])
              ->send();
if ($res === FALSE) {
    echo $invite->errMsg();
}
```

### Test
```sh
./vendor/bin/phpunit --tap tests
```

### Licence
```
MIT
```
