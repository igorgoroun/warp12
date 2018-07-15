# Warp12
A simple site management system written on Symfony.

### Install:
```
composer require snakemkua/warp12bundle
composer require stof/doctrine-extensions-bundle
```

### Register bundle
Add line to file app/AppKernel.php into $bundles
```
$bundles = [
    ...
    new snakemkua\Warp12Bundle\Warp12Bundle(),
]
```

### Create new module bundle

```bash
bin/console generate:bundle

```
Activate it if it wasn't activated automatically - add record to composer.json:
```json
"autoload": {
  "psr-4": {
    "": "src/"
  }
}
```
and recompile autoload:
```text
composer dump-autoload
```

# Configure bundle to be a module

### Implement your controller:
```php
class DefaultController extends Controller implements WarpModuleInterface
{
    public function warpDropdownMenu(Request $request){
    }
   
    public function warpUIRenderLayout(Request $request){
    }

    public function warpTopLine(Request $request){
    }
}
```

### Define template for default page
```yaml
parameters:
  warp12templates:
    page_default: YourBundle:Default:page.html.twig
    #page_404:YourBundle:Default:404.html.twig
```

You can create a hook page if you need to send more data to your template.
Hook page content: 
```twig
{{ render(controller(('YourBundle\\Controller\\DefaultController::renderPage'), {'request': app.request, 'page': page})) }}
```

