Galves-API
==========

Galves Vehicle Information API

```php
use Galves\Api\Client;

$galves = new Client();

// Login to get authToken
$galves->login([
    'username' => 'some_username',
    'acctNo' => '123456',
]);

// Get years
$years = $galves->getYears(); // [1998, 1999, 2000, 2001, ...]

// Get Makes
$makes = $galves->getMakes(); // ['BMW', 'Ford', ...]

// Get Models
$models = $galves->getModels(1990, 'BMW'); // ['3 Series', '4 Series', ...]

// Get Styles
$styles = $galves->getStyles(1990, 'BMW', '3 Series'); // ['guid' => 'style', 'guid2' => 'style2']

// Get Vehicle
$vehicle = $galves->getVehicle($guid);

// Get Mileage Adjustment
$adjust = $galves->getMileageAdjustment($guid, 123456); // (int)-450
```
