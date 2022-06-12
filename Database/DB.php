<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;

class DB
{
    private static array $connectionParams = [
        'dbname' => 'shop_db',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];

    public static function getDB(): QueryBuilder
    {
        $conn = DriverManager::getConnection(self::$connectionParams);
        $queryBuilder = $conn->createQueryBuilder();

        return $queryBuilder;
    }

    /**
     * Returns Products sorted alphabetically
     *
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    public static function getProducts(): array
    {
        return self::getDB()
            ->select('pk_product_id', 'product_name', 'product_price', 'product_image')
            ->from('Product')
            ->orderBy('product_name',)
            ->executeQuery()
            ->fetchAllAssociative();
    }

    /**
     * Deletes specified Product from Database
     *
     * @param int $pk_product_id
     * @throws \Doctrine\DBAL\Exception
     */
    public static function deleteProduct(int $pk_product_id): void
    {
        self::getDB()
            ->delete('Product')
            ->where('pk_player_id = ?')
            ->setParameter(0, $pk_product_id, ParameterType::INTEGER)
            ->executeQuery();
    }


    /**
     * Adds specified Product to Database
     *
     * @param string $product_name
     * @param string $product_price
     * @param string $product_image
     * @throws \Doctrine\DBAL\Exception
     */
    public static function addProduct(string $product_name, string $product_price, string $product_image): void
    {
        self::getDB()
            ->insert('Product')
            ->values(
                ['product_name' => '?', 'product_price' => '?', 'product_image' => '?'])
            ->setParameter(0, $product_name)
            ->setParameter(1, $product_price)
            ->setParameter(2, $product_image)
            ->executeQuery();
    }
}