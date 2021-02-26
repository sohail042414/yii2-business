<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
       <?php
            NavBar::begin([
                'brandLabel' => 'Logo Here &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            //Left nav bar
            $menuItems = [];
            if (!Yii::$app->user->isGuest) { 
                $menuItems = [
                    [
                        'label'=>'Stock', 
                        'url'=>['/stock/index'], 
                        'items'=>[
                            ['label'=>'Categories', 'url'=>['/stock/category/index']],
                            ['label'=>'Items', 'url'=>['/stock/item/index']],
                            ['label'=>'Purchase List', 'url'=>['/stock/purchase/index']],
                            ['label'=>'Bills/Sales', 'url'=>['/stock/sale/index']],
                        ]
                    ],
                    ['label' => 'Suppliers', 'url' => ['/vendor/index']],
                    ['label' => 'Customers', 'url' => ['/client/index']],
                    [
                        'label'=>'Accounts', 
                        'url'=>['/accounts/index'], 
                        'items'=>[
                            ['label'=>'Accounts Tree', 'url'=>['/accounts/tree/index']],
                            ['label'=>'Accounts Receivable', 'url'=>['/accounts/receivable/index']],
                            ['label'=>'Accounts Payable', 'url'=>['/accounts/payable/index']],
                        ]
                    ],
                    [
                        'label'=>'Reports', 
                        'url'=>['/reports/index'], 
                        'items'=>[
                            ['label'=>'Trail Balance', 'url'=>['/reports/trailbalance/index']],
                            ['label'=>'By Vendor', 'url'=>['/account/payable/index']],
                            ['label'=>'By Client', 'url'=>['/account/receivable/index']],
                        ]
                    ],
                    [
                        'label'=>'Others',         
                        'items'=>[
                            ['label'=>'Cities', 'url'=>['/city/index']],
                            ['label'=>'Cargo Terminals (Builty Adday)', 'url'=>['/cargo-terminal/index']],
                            ['label'=>'Units', 'url'=>['/unit/index']]
                        ]
                    ],
                ];                    
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $menuItems,
            ]);

            //Right nav bar
            $menuItems = [];

            if (Yii::$app->user->isGuest) { 
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else { 
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();

        ?>

        <div class="container"> 
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?php if (Yii::$app->session->hasFlash('success_message')){ ?>
                <div class="alert alert-success">
                    <?php echo Yii::$app->session->getFlash('success_message'); ?>
                </div>
            <?php } ?>

            <?php if (Yii::$app->session->hasFlash('error_message')){ ?>
                <div class="alert alert-danger">
                <?php echo Yii::$app->session->getFlash('error_message'); ?>
                </div>
            <?php } ?>

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Ajk Technologies <?= date('Y') ?></p>
            <p class="pull-right"><?php // Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
