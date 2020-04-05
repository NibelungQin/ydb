<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2019/5/15
 * Time: 10:39
 */
return [
  'name' => 'Yidaobao Project Migrations',
  'migrations_namespace' => 'Ydb\Migrations',
  'table_name' => 'ydb_migration_versions',
  'column_name' => 'version',
  'column_length' => 14,
  'executed_at_column_name' => 'executed_at',
  'migrations_directory' => __DIR__ . '/db/Migrations',
  'all_or_nothing' => true,
];