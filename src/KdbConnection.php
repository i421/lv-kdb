<?php

namespace I421\Kdb;

use Illuminate\Database\Connection;
use I421\Kdb\Builder\KdbBuilder;
use I421\Kdb\Processor\KdbProcessor;
use Doctrine\DBAL\Driver\PDOPgSql\Driver as DoctrineDriver;
use I421\Kdb\Grammar\Query\KdbGrammar as QueryGrammar;
use I421\Kdb\Grammar\Schema\KdbGrammar as SchemaGrammar;

class KdbConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \App\Cockroach\Query\CockroachGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \Illuminate\Database\Schema\PostgresBuilder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new KdbBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \App\Cockroach\Schema\CockroachGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \Illuminate\Database\Query\Processors\PostgresProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new KdbProcessor();
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \Doctrine\DBAL\Driver\PDOPgSql\Driver
     */
    protected function getDoctrineDriver()
    {
        return new DoctrineDriver;
    }
}

