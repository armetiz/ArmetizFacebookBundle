ArmetizFacebookBundle
=====================

A simple bundle to expose Facebook SDK.

## Usage example

```php
<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    public function indexAction($facebookId, $facebookToken) {
        $facebookSdk = $this->get("armetiz.facebook");
        
        $facebookSdk->setAccessToken($facebookToken);
        $userProfile = $facebookSdk->api('/' . $facebookId, 'GET');
    }

}
?>
```

## Installation

Installation is a quick 4 step process:

1. Download ArmetizFacebookBundle using composer
2. Enable the Bundle
3. Configure your application's config.yml

### Step 1: Download FOSUserBundle using composer

Add ArmetizFacebookBundle in your composer.json:

```js
{
    "require": {
        "armetiz/facebook-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update armetiz/facebook-bundle
```

Composer will install the bundle to your project's `vendor/armetiz` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Armetiz\FacebookBundle\ArmetizFacebookBundle(),
    );
}
```
### Step 3: Configure your application's config.yml

Finally, add the following to your config.yml

``` yaml
# app/config/config.yml
armetiz_facebook:
    enabled: true
    sdk:
        myApplicationA:
            app_id: 1234567890
            secret: 1234567890
        myApplicationB:
            app_id: 0987654321
            secret: 0987654321
            default: true
            enabled: false
```

## Configuration
This bundle can be configured, and this is the list of what you can do :
- Create many SDK.
- Define specific app_id / secret for each SDK.
- Disable this bundle. This options is optional and default value is true. 
- Disable each SDK. This options is optional and default value is true. 

**Note:**

```
You can retreive each connection using the container with "armetiz.facebook.[sdk_name]".

When you define a "default" connection. You can have a direct access to it with "armetiz.facebook".
```

``` php
<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    public function indexAction($facebookId, $facebookToken) {
        $facebookSdkA = $this->get("armetiz.facebook.myApplicationA");
        $facebookSdkB = $this->get("armetiz.facebook.myApplicationB");
        
        $facebookSdkA->setAccessToken($facebookToken);
        $facebookSdkB->setAccessToken($facebookToken);

        $userProfileFromA = $facebookSdkA->api('/' . $facebookId, 'GET');
        $userProfileFromB = $facebookSdkB->api('/' . $facebookId, 'GET');
    }

}
?>
```