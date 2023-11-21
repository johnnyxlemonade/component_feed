<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;
use Lemonade\Feed\BaseItem;
use Lemonade\Pdf\Data\Order;

/**
 * @OrderHeader
 * @\Lemonade\Feed\Data\Money\OrderHeader
 */
final class OrderHeader extends BaseItem
{

    /**
     * @var array
     */
    protected array $config = [
        "DatumSchvaleni" => "",
        "DatumVystaveni" => "",
        "VariabilniSymbol" => "",
        "Nazev" => "",
        "Sleva" => "",
        "Poznamka" => "",
        "Vystavil" => "Eshop"
    ];

    /**
     * Adresy
     * @var array|null[]
     */
    protected array $connectionAddress = [
        "data" => null,
        "country" => null,
        "company" => null,
    ];

    /**
     * Adresy
     * @var array|null[]
     */
    protected array $billingAddress = [
        "data" => null,
        "country" => null,
        "company" => null,
    ];

    /**
     * Adresy
     * @var array|null[]
     */
    protected array $deliveryAddress = [
        "data" => null,
        "country" => null,
        "company" => null,
    ];

    /**
     * Doprava
     * @var OrderShipping|null
     */
    protected ?OrderShipping $shipping = null;

    /**
     * Platba
     * @var OrderPayment|null
     */
    protected ?OrderPayment $payment = null;

    /**
     * Mena
     * @var OrderCurrency|null
     */
    protected ?OrderCurrency $currency = null;

    /**
     * Skupina
     * @var OrderGroup|null
     */
    protected ?OrderGroup $group = null;

    /**
     * Polozky
     * @var array<OrderItem>
     */
    protected array $items = [];

    /**
     * DPH sazby
     * @var array
     */
    protected array $dphRates = [];


    /**
     * @param string|int $orderId
     */
    public function __construct(protected readonly string|int $orderId) {}

    /**
     * @param string $date
     * @return void
     */
    public function setDate(string $date): void
    {

        $this->config["DatumSchvaleni"] = Date(format: "Y-m-dTH:i:s", timestamp: strtotime(datetime: $date));
        $this->config["DatumVystaveni"] = Date(format: "Y-m-dTH:i:s", timestamp: strtotime(datetime: $date));
    }

    /**
     * @param string $vs
     * @return void
     */
    public function setVS(string $vs): void
    {
        $this->config["VariabilniSymbol"] = $vs;
        $this->config["Nazev"] = sprintf("Objednávka z eshopu č. %s", $vs);
    }

    /**
     * @param string|null $note
     * @return void
     */
    public function setNote(string $note = null): void
    {
        $this->_setItem(index: "Poznamka", value: $note);
    }

    /**
     * @param Address|null $address
     * @param AddressCountry|null $country
     * @param AddressCompany|null $company
     * @return void
     */
    public function setConnectionAddress(?Address $address = null, ?AddressCountry $country = null, ?AddressCompany $company = null): void
    {

        $this->connectionAddress["data"]    = $address;
        $this->connectionAddress["country"] = $country;
        $this->connectionAddress["company"] = $company;
    }

    /**
     * @param Address|null $address
     * @param AddressCountry|null $country
     * @param AddressCompany|null $company
     * @return void
     */
    public function setBillingAddress(?Address $address = null, ?AddressCountry $country = null, ?AddressCompany $company = null): void
    {

        $this->billingAddress["data"]    = $address;
        $this->billingAddress["country"] = $country;
        $this->billingAddress["company"] = $company;
    }

    /**
     * @param Address|null $address
     * @param AddressCountry|null $country
     * @param AddressCompany|null $company
     * @return void
     */
    public function setDeliveryAddress(?Address $address = null, ?AddressCountry $country = null, ?AddressCompany $company = null): void
    {

        $this->deliveryAddress["data"]    = $address;
        $this->deliveryAddress["country"] = $country;
        $this->deliveryAddress["company"] = $company;
    }

    /**
     * @param OrderShipping|null $shipping
     * @return void
     */
    public function setShipping(?OrderShipping $shipping = null): void
    {

        $this->shipping = $shipping;
    }

    /**
     * @param OrderPayment|null $payment
     * @return void
     */
    public function setPayment(?OrderPayment $payment = null): void
    {

        $this->payment = $payment;
    }

    /**
     * @param OrderCurrency|null $currency
     * @return void
     */
    public function setCurrency(?OrderCurrency $currency = null): void
    {

        $this->currency = $currency;
    }

    /**
     * @param OrderGroup|null $group
     * @return void
     */
    public function setGroup(?OrderGroup $group = null): void
    {

        $this->group = $group;
    }

    /**
     * @param OrderItem $item
     * @return void
     */
    public function addItem(OrderItem $item): void
    {

        $this->items[] = $item;
    }

    /**
     * @return Address
     */
    public function getConnetionAddress(): Address
    {
        return ($this->connectionAddress["data"] ?: new Address());
    }

    /**
     * @return AddressCountry
     */
    public function getConnetionCountry(): AddressCountry
    {

        return ($this->connectionAddress["country"] ?: new AddressCountry());
    }

    /**
     * @return AddressCompany
     */
    public function getConnetionCompany(): AddressCompany
    {

        return ($this->connectionAddress["company"] ?: new AddressCompany());
    }

    /**
     * @return Address
     */
    public function getBillingAddress(): Address
    {
        return ($this->billingAddress["data"] ?: new Address());
    }

    /**
     * @return AddressCountry
     */
    public function getBillingCountry(): AddressCountry
    {

        return ($this->billingAddress["country"] ?: new AddressCountry());
    }

    /**
     * @return AddressCompany
     */
    public function getBillingCompany(): AddressCompany
    {

        return ($this->billingAddress["company"] ?: new AddressCompany());
    }

    /**
     * @return Address
     */
    public function getDeliveryAddress(): Address
    {

        return ($this->deliveryAddress["data"] ?: new Address());
    }

    /**
     * @return AddressCountry
     */
    public function getDeliveryCountry(): AddressCountry
    {

        return ($this->deliveryAddress["country"] ?: new AddressCountry());
    }

    /**
     * @return AddressCompany
     */
    public function getDeliveryCompany(): AddressCompany
    {

        return ($this->deliveryAddress["company"] ?: new AddressCompany());
    }

    /**
     * @return OrderCurrency
     */
    public function getCurrency(): OrderCurrency
    {

        return ($this->currency ?: new OrderCurrency());
    }

    /**
     * @return OrderShipping
     */
    public function getShipping(): OrderShipping
    {

        return ($this->shipping ?: new OrderShipping());
    }

    /**
     * @return OrderPayment
     */
    public function getPayment(): OrderPayment
    {

        return ($this->payment ?: new OrderPayment());
    }

    /**
     * @return OrderGroup
     */
    public function getGroup(): OrderGroup
    {

        return ($this->group ?: new OrderGroup());
    }

    /**
     * @return OrderSummary
     */
    public function getSummary(): OrderSummary
    {

        return new OrderSummary(items: $this->items);
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {

        return $this->items;
    }



    /**
     * @return string
     */
    public function getDatumSchvaleni(): string
    {
        return $this->_getItem(index: "DatumSchvaleni");
    }

    /**
     * @return string
     */
    public function getVariabilniSymbol(): string
    {
        return $this->_getItem(index: "VariabilniSymbol");
    }

    /**
     * @return string
     */
    public function getNazev(): string
    {
        return $this->_getItem(index: "Nazev");
    }

    /**
     * @return string
     */
    public function getPoznamka(): string
    {
        return $this->_getItem(index: "Poznamka");
    }

    /**
     * @return string
     */
    public function getVystavil(): string
    {
        return $this->_getItem(index: "Vystavil");
    }

    /**
     *
     * @return string
     */
    public static function getErrorString(): string
    {

        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><S5Data/>";
    }

    /**
     * @param string $index
     * @return mixed|string
     */
    protected function _getItem(string $index)
    {

        return (string) ($this->config[$index] ?? "");
    }

    /**
     * @param string $index
     * @param string|int|null $value
     * @return void
     */
    protected function _setItem(string $index, string|int|null $value = null): void
    {

        if(!empty($value)) {

            $this->config[$index] = $value;
        }

    }

}