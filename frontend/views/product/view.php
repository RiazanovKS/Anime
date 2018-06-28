<?php
/* @var $this yii\web\View */

/* @var $model \backend\models\Product */

use yii\helpers\Html;
use backend\models\Base;
use yii\widgets\Pjax;

$this->params['breadcrumbs'] = \frontend\controllers\CategoryController::getBreadcrumbs($model->category_id, false);
$this->params['breadcrumbs'][] = ['label' => $model->name];


$this->registerJsFile('/js/product/product.js', ['position' => \yii\web\View::POS_END, 'depends' => 'yii\web\YiiAsset']);


$this->title = $model->name;
$index = 0;

$costCurNone = $model->cost;
$costOldNone = (!empty($model->cost_old)) ? $model->cost_old : 0;

?>

<section class="page__section">
    <div class="columns">
        <div class="columns__item">
            <div class="product">
                <? if ($model->flags != 0): ?>
                    <div class="product__badge"><?= $model->AllFlagsAsArray()[$model->flags] ?></div>
                <? endif; ?>

                

                <div class="product__column">
                    <div class="slider js-product__slider">
                        <div class="slider__slide">
                            <div class="adjuster">
                                <canvas class="adjuster__canvas" height="1" width="1"></canvas>
                                <img class="adjuster__image adjuster__image_centered"
                                     data-lazy="<?= $model->getSRCPhoto(['index' => 0, 'suffix' => '_big']) ?>"
                                     alt="<?= $model->name ?>">
                            </div>
                        </div>
                        <? foreach ($gallery as $photo) : ?>
                            <div class="slider__slide">
                                <div class="adjuster">
                                    <canvas class="adjuster__canvas" height="1" width="1"></canvas>
                                    <img class="adjuster__image adjuster__image_centered"
                                         data-lazy="<?= $photo->getSRCPhoto(['parent_id' => $model->id, 'suffix' => '_big']) ?>"
                                         alt="<?= $photo->name ?>">
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <? if (!empty($model->text)) : ?>
                <div class="product-info product-info_bottom">
                    <div class="product-info__title title title_size_s title_low">Описание</div>
                    <div class="user-content">
                        <?= $model->text ?>
                    </div>
                </div>
            <? endif; ?>
        </div>
        <div class="columns__item columns__item_small">
            <div class="params">
                <div class="params__title title title_size_s title_low"> <?= $model->name ?></div>
                <? if (!empty($model->article)) : ?>
                    <div class="params__field">
                        <div class="user-content">
                            <?= $model->article ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if (!empty($model->params)): ?>
                    <? $params = $model->getParams()->orderBy(['pos'=>SORT_DESC])->all();?>
                    <? foreach ($params as $param): ?>
                        <? /* @var $param \backend\models\ProductParam */ ?>
                        <? $options = json_decode($param->value) ?>
                        <? $costCurNone += $options[0]->cost; ?>
                        <? $costOldNone += $options[0]->cost; ?>
                  
                        <div id="<?= $param->id ?>_field" class="params__field">
                            <div id="label_<?= $param->id ?>" class="params__label"><?= $param->name ?></div>
                            <div class="select">
                                <select id="select_<?= $param->id ?>" type="select" class="select__input">
                                    <? foreach ($options as $key => $option): ?>
                                        <option cost="<?= $option->cost ?>"
                                                value="<?= $key ?>"><?= $option->value ?></option>
                                    <? endforeach; ?>
                                </select>
                                <div class="select__dummy"></div>
                            </div>
                        </div>

                    <? endforeach; ?>
                <? endif; ?>
                <? if (!empty($model->anons)) : ?>
                    <div class="params__field">
                        <div class="user-content">
                            <?= $model->anons ?>
                        </div>
                    </div>
                <? endif; ?>
                <? $captionText = \backend\models\StaticTextItem::findOne(['id'=>\backend\models\StaticTextItem::PRODUCT_CAPTION_TEXT])->text?>
                <? if (!empty($captionText)):?>
                <div class=params__field-l>
                    <div class=params__caption><?= $captionText?>
                    </div>
                </div>
                <? endif; ?>

                <div class="params__submit">
                    <a href="#popup_add-to-cart watch-button" id="add-to-cart" prodID="<?= $model->id ?>"
                       class="button button_size_l js-popup__open" data-effect="mfp-zoom-in">Смотреть</a>
                </div>
            </div>
        </div>
</section>
<? if (!empty($otherProducts)) : ?>
    <section class="page__section-main">
        <h2 class="title title_top">
            Другие сериалы из категории
        </h2>
        <div class="items-slider">
            <div class="items-slider__container swiper-container js-items-slider">
                <?= $this->render('@frontend/views/category/_item', compact('otherProducts', 'index')); ?>
            </div>
            <div class="items-slider__button js-items-slider__prev">
                <svg class="items-slider__icon">
                    <use xlink:href="#icon-arrow-down"></use>
                </svg>
            </div>
            <div class="items-slider__button items-slider__button_next js-items-slider__next">
                <svg class="items-slider__icon">
                    <use xlink:href="#icon-arrow-down"></use>
                </svg>
            </div>
            <? if (false) {
                echo '<div class="slider-pagination slider-pagination_bottom js-items-slider__pagination"></div>';
            } ?>
        </div>
    </section>
<? endif; ?>