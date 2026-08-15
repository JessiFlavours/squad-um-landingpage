<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$host    = $_ENV['DATABASE_URL'];
$port    = $_ENV['DATABASE_PORT'] ?? '3306';
$dbname  = $_ENV['DATABASE_NAME'];
$user    = $_ENV['DATABASE_USER'];
$pass    = $_ENV['DATABASE_PASSWORD'];
$charset = $_ENV['DATABASE_CHARSET'] ?? 'utf8mb4';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_SSL_CA => null,
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ]
    );

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Banco '$dbname' pronto\n";

    $pdo->exec("USE `$dbname`");

    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id         INT           AUTO_INCREMENT PRIMARY KEY,
        nome       VARCHAR(100)  NOT NULL,
        email      VARCHAR(150)  NOT NULL UNIQUE,
        senha      VARCHAR(255)  NOT NULL,
        created_at DATETIME      NOT NULL DEFAULT NOW(),
        deleted_at DATETIME      NULL DEFAULT NULL
    )");
    echo "Tabela 'usuarios' pronta\n";

    $pdo->exec("CREATE TABLE IF NOT EXISTS tarefas (
        id             INT           AUTO_INCREMENT PRIMARY KEY,
        titulo         VARCHAR(200)  NOT NULL,
        descricao      TEXT          NULL,
        status         ENUM('pendente','em_andamento','concluida') NOT NULL DEFAULT 'pendente',
        criado_por_id  INT           NOT NULL,
        atribuido_a_id INT           NULL,
        created_at     DATETIME      NOT NULL DEFAULT NOW(),
        updated_at     DATETIME      NULL ON UPDATE NOW(),
        deleted_at     DATETIME      NULL DEFAULT NULL,
        CONSTRAINT fk_tarefas_criador     FOREIGN KEY (criado_por_id)  REFERENCES usuarios(id) ON DELETE CASCADE,
        CONSTRAINT fk_tarefas_responsavel FOREIGN KEY (atribuido_a_id) REFERENCES usuarios(id) ON DELETE SET NULL
    )");
    echo "Tabela 'tarefas' pronta\n";

    echo "\nMigration concluida com sucesso!\n";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}