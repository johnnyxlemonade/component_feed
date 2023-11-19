<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;

/**
 * @OrderItem
 * @\Lemonade\Feed\Data\Money\OrderItem
 * @method getItemId
 * @method getItemName
 * @method getItemProductCatalog
 * @method getItemProductCode
 * @method getItemProductUnitCode
 * @method getItemQuantity
 * @method getItemProductPosition
 * @method getRootBase
 * @method getRootPrice
 * @method getUnitBase
 * @method getUnitPrice
 * @method getVatBase
 * @method getVatRate
 */
final class OrderItem
{

    use TraitArray;
}