<?php

namespace Application\Commands;

use Infrastructure\Facades\Config;
use Infrastructure\Facades\Connection;
use Infrastructure\Interfaces\SeedInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SeedDatabaseCommand extends Command
{
    protected function configure() :void
    {
        $this
            ->setName('db:seed')
            ->setDescription('Seed Database');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $output->writeln('Seeding');

        $seeds = Config::get('database.seeds');

        /** @var SeedInterface $seed */
        foreach ($seeds as $seed) {
            $seedClass = new $seed(Connection::instance());
            $seedClass->seed();

            $output->writeln('Seeded: ' . get_class($seedClass));
        }

        $output->writeln('Done');

        return 0;
    }
}