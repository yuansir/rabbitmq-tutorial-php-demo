<?php

/**
 * PHP amqp(RabbitMQ) Demo-3
 * @author  yuansir <yuansir@live.cn/yuansir-web.com>
 */

$exchangeName = 'logs';
$message = empty($argv[1]) ? 'info:Hello World!' : ' '.$argv[1];

$connection = new AMQPConnection(array('host' => '127.0.0.1', 'port' => '5672', 'vhost' => '/', 'login' => 'guest', 'password' => 'guest'));
$connection->connect() or die("Cannot connect to the broker!\n");

$channel = new AMQPChannel($connection);
$exchange = new AMQPExchange($channel);
$exchange->setName($exchangeName);
$exchange->setType(AMQP_EX_TYPE_FANOUT);
$exchange->declare();

$exchange->publish($message, '');
var_dump("[x] Sent $message");

$connection->disconnect();
