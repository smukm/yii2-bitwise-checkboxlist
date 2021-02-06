# Bitwise checkbox list for Yii 2

## Installation

Install extension through [composer](http://getcomposer.org/):

```
composer require smukm/yii2-bitwise-checkboxlist
```

## Usage

The following code in a view file would render a group of checkboxes:

```php
<?= smukm\bcl\BitwiseCheckboxList::widget([
'name' => 'attributeName',
'data' => ['1' => 'New', '2' => 'Paid', '4' => 'Delivered', '8' => 'Complete'],
'columns' => 2,
]) ?>
```

If you want to use this input widget in an ActiveForm, it can be done like this:

```php
<?= $form->field($model, 'attributeName')->widget(smukm\bcl\BitwiseCheckboxList::class, [
    'data' => ['1' => 'New', '2' => 'Paid', '4' => 'Delivered', '8' => 'Complete'],
]) ?>
```
