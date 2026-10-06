<?php

class Align_products_with_lab6
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
    }

    public function up()
    {
        $columns = $this->_lava->db->raw('SHOW COLUMNS FROM `products`')->fetchAll(PDO::FETCH_COLUMN);

        if (!in_array('product_name', $columns, true)) {
            throw new RuntimeException('The products table is missing product_name.');
        }

        $this->_lava->db->raw('ALTER TABLE `products` MODIFY `product_name` VARCHAR(100) NOT NULL');

        if (!in_array('created_at', $columns, true)) {
            $this->_lava->db->raw('ALTER TABLE `products` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        }
    }

    public function down()
    {
        $columns = $this->_lava->db->raw('SHOW COLUMNS FROM `products`')->fetchAll(PDO::FETCH_COLUMN);
        if (in_array('created_at', $columns, true)) {
            $this->_lava->db->raw('ALTER TABLE `products` DROP COLUMN `created_at`');
        }
    }
}
