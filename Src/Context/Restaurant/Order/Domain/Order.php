<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Domain;

use App\Context\Restaurant\OrderItem\Domain\OrderItem;
use App\Context\Restaurant\OrderItem\Domain\OrderItemQuantity;
use App\Context\Restaurant\OrderItem\Domain\OrderItemTotalPrice;
use App\Context\Restaurant\Product\Domain\Product;
use App\Context\Shared\Constants\EnumOrderStatus;
use App\Context\Shared\Domain\Aggregate\AggregateRoot;
use App\Utilities\UuidGenerator;

class Order extends AggregateRoot
{
    public readonly OrderId $id;

    public readonly OrderStatus $status;

    /**
     * @var OrderItem[]
     */
    private array $orderItems = [];

    public function __construct(OrderId $id, OrderStatus $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id->getValue(),
            'status' => $this->status->getValue(),
        ];
    }

    static function create(): Order
    {
        return new self(
            new OrderId(UuidGenerator::generate()),
            new OrderStatus(EnumOrderStatus::PENDING)
        );
    }

    static function fromPrimitives(string $id, string $status): Order
    {
        return new self(
            new OrderId($id),
            new OrderStatus(EnumOrderStatus::transforStringToEnum($status))
        );
    }

    public function addItem(Product $product, OrderItemQuantity $quantity): void
    {
        $orderItem = OrderItem::create(
            $this->id,
            $product->id,
            $quantity,
            new OrderItemTotalPrice($product->price->getValue() * $quantity->getValue())
        );
        array_push($this->orderItems, $orderItem);
    }

    public function addOrderItem(OrderItem $orderItem): void
    {
        array_push($this->orderItems, $orderItem);
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->orderItems;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->orderItems as $item) {
            $total += $item->totalPrice->getValue();
        }
        return $total;
    }
}
