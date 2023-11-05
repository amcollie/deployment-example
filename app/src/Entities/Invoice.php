<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\InvoiceItem;
use App\Enums\InvoiceStatus;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'invoices')]
#[HasLifecycleCallbacks]
class Invoice
{
    #[Id]
    #[Column(type: Types::INTEGER), GeneratedValue]
    private int $id;

    #[Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $amount;

    #[Column(name: 'invoice_number', type: Types::STRING)]
    private string $invoiceNumber;

    #[Column(enumType: InvoiceStatus::class)]
    private InvoiceStatus $status;

    #[Column(name: 'due_date', type: Types::DATETIME_MUTABLE)]
    private DateTime $dueDate;

    #[Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[OneToMany(targetEntity: InvoiceItem::class, mappedBy: 'invoice', cascade: ['persist','remove'])]
    private Collection $items ;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): Invoice
    {
        $this->amount = $amount;
        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): Invoice
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getStatus(): InvoiceStatus
    {
        return $this->status;
    }

    public function setStatus(InvoiceStatus $status): Invoice
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(DateTime $dueDate): Invoice
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    #[PrePersist]
    public function onPrePersist(LifecycleEventArgs $args): void
    {
        $this->createdAt = new DateTime();
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(InvoiceItem $item): Invoice
    {
        $item->setInvoice($this);

        $this->items->add($item);

        return $this;
    }
}