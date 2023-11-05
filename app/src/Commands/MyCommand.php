<?php

declare(strict_types=1);

namespace App\Commands;

use App\Services\InvoiceService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MyCommand extends Command
{
    protected static $defaultName = 'app:my-command';
    protected static $defaultDescription = 'My Command';

    public function __construct(private readonly InvoiceService $invoiceService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Paid Invoices:' . count($this->invoiceService->getPaidInvoices()));
        return Command::SUCCESS;
    }
}