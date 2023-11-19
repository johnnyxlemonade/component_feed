<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;

/**
 * @OrderSummary
 * @\Lemonade\Feed\Data\Money\OrderSummary
 */
final class OrderSummary
{

    /**
     * @var array|array[]
     */
    protected array $lines = [
        0 => [
            "index" => 0,
            "rootBase" => 0,
            "rootPrice" => 0,
            "unitBase" => 0,
            "unitPrice" => 0,
            "vatBase" => 0,
            "vatRate" => 15
        ],
        15 => [
            "index" => 1,
            "rootBase" => 0,
            "rootPrice" => 0,
            "unitBase" => 0,
            "unitPrice" => 0,
            "vatBase" => 0,
            "vatRate" => 15
        ],
        21 => [
            "index" => 2,
            "rootBase" => 0,
            "rootPrice" => 0,
            "unitBase" => 0,
            "unitPrice" => 0,
            "vatBase" => 0,
            "vatRate" => 21
        ]
    ];

    /**
     * @var array|array[]
     */
    protected array $total = [
        "rootBase" => 0,
        "rootPrice" => 0,
        "unitBase" => 0,
        "unitPrice" => 0,
        "vatBase" => 0,
    ];

    /**
     * @param array $items
     */
    public function __construct(protected readonly array $items) {}


    /**
     * DPH sazby
     * @return array
     */
    public function getLines(): array
    {

        $this->_parseConfig();

        return $this->lines;
    }

    /**
     * Souhrn
     * @return array
     */
    public function getTotal(): array
    {

        $this->_parseConfig();

        foreach($this->lines as $val) {

            $this->total["rootBase"] += ($val["rootBase"] ?? 0);
            $this->total["rootPrice"] += ($val["rootPrice"] ?? 0);
            $this->total["unitBase"] += ($val["unitBase"] ?? 0);
            $this->total["unitPrice"] += ($val["unitPrice"] ?? 0);
            $this->total["vatBase"] += ($val["vatBase"] ?? 0);
        };

        return $this->total;
    }

    /**
     * @return void
     */
    protected function _parseConfig(): void
    {
        /**
         * @var OrderItem $item
         */
        foreach($this->items as $item) {

            if(isset($this->lines[$item->getVatRate()])) {

                $this->lines[$item->getVatRate()]["rootBase"] += $item->getRootBase();
                $this->lines[$item->getVatRate()]["rootPrice"] += $item->getRootPrice();
                $this->lines[$item->getVatRate()]["unitBase"] += $item->getUnitBase();
                $this->lines[$item->getVatRate()]["unitPrice"] += $item->getUnitPrice();
                $this->lines[$item->getVatRate()]["vatBase"] += $item->getVatBase();

            } else {

                $this->lines[$item->getVatRate()]["rootBase"] += $item->getRootBase();
                $this->lines[$item->getVatRate()]["rootPrice"] += $item->getRootPrice();
                $this->lines[$item->getVatRate()]["unitBase"] += $item->getUnitBase();
                $this->lines[$item->getVatRate()]["unitPrice"] += $item->getUnitPrice();
                $this->lines[$item->getVatRate()]["vatBase"] += $item->getVatBase();
                $this->lines[$item->getVatRate()]["vatRate"] += $item->getVatRate();
            }
        }

    }

}