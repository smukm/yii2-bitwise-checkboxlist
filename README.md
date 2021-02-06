# Bitwise checkbox list for Yii 2

This extension renders an input with [jQuery MiniColors](https://github.com/claviska/jquery-minicolors).

## Installation

Install extension through [composer](http://getcomposer.org/):

```
composer require vv68/yii2-bitwise-checkboxlist
```

## Usage

The following code in a view file would render a group of checkboxes:

```php
<?= vv68\bcl\BitwiseCheckboxList::widget([
'name' => 'attributeName',
'data' => ['1' => 'New', '2' => 'Paid', '4' => 'Delivered', '8' => 'Complete'],
'columns' => 2,
]) ?>
```

If you want to use this input widget in an ActiveForm, it can be done like this:

```php
<?= $form->field($model, 'attributeName')->widget(vv68\bcl\BitwiseCheckboxList::class, [
    'data' => ['1' => 'New', '2' => 'Paid', '4' => 'Delivered', '8' => 'Complete'],
]) ?>
```
