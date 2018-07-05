# Yireo ExampleAddressFieldNote
This module integrates a new fields (`note`) in various ways in the existing fieldsets of a shipment address. The `note` field follows the pattern of an Extension Attribute (programmatically added value).

- Setup procedure
- Shipment Address step in the checkout
- Address form under the Customer Account

## Installation
```
composer require yireo-training/magento2-example-address-field-note:dev-master
```

### Setup procedure
Through a file `Setup/InstallData.php` the field `note` is added to the database as an invisible field. The only purpose for this EAV attribute is to serve as backend to show the behaviour of Extension Attributes. Normally, an Extension Attribute would sync itself with some other table or perhaps even an external resource. This is only an example. If you need to a EAV attribute after all, forget about this approach and create a Custom Attribute instead. This procedure for Extension Attributes is to allow for complexer attributes to be stored outside of EAV.

### Address form under the Customer Account
This is actually bad code: While the customer-entity can be cleanly extended using a form API, the address form is not easy to extend: Its fields are hard-coded in PHTML. Therefore, a plugin was created (`etc/di.xml`) to hack the new field `comment` (`Block/Address/Edit/Field/Note.php`) into the right place. 

The block-class calls for the `note` value through the Extension Attribute code.

### XML file `extension_attributes.xml`
 To make the field `note` known as an Extension Attribute, it is added to the file `extension_attributes.xml`.

### Shipment Address step in the checkout
The `note` field is added through the Extension Attribute method. There are 2 ways to add your own fields in the checkout: Either through XML layout code or through a PHP-based layout processor. The latter is choosen in this example, because it would allow for the XML layout update to be done automatically (depending on some kind of PHP logic). The layout processor is first added to `etc/di.xml` and then defined in `Processor/NoteAddressField.php`.
