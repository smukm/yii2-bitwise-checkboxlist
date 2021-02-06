<?php
namespace backend\widgets\BitwiseCheckboxList;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class BitwiseCheckboxAsset extends AssetBundle
{

    public $sourcePath = '@backend/widgets/BitwiseCheckboxList/assets';
    public $js = [
        YII_ENV_DEV ? 'bw_checkboxlist.js' : 'bw_checkboxlist.min.js',
    ];

    public $depends = [
      JqueryAsset::class
    ];
}