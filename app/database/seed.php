<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$host    = getenv('DATABASE_URL');
$port    = getenv('DATABASE_PORT') ?: '3306';
$dbname  = getenv('DATABASE_NAME');
$user    = getenv('DATABASE_USER');
$pass    = getenv('DATABASE_PASSWORD');
$charset = getenv('DATABASE_CHARSET') ?: 'utf8mb4';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_SSL_CA => null,
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ]
    );

    echo "Iniciando a inserção de dados (Seed)...\n";

    // ==========================================
    // 1. SEED DE USUÁRIO ÚNICO
    // ==========================================
    $nome = 'Admin';
    $email = 'admin@email.com';
    $senhaPadrao = password_hash('123456', PASSWORD_DEFAULT);

    // Verifica se o usuário já existe
    $stmtCheckUser = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmtCheckUser->execute([$email]);
    
    if ($stmtCheckUser->rowCount() == 0) {
        // Insere o novo usuário
        $stmtInsertUser = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmtInsertUser->execute([$nome, $email, $senhaPadrao]);
        echo "👤 Usuário '{$nome}' ({$email}) criado com sucesso.\n";
    } else {
        echo "⏩ Usuário '{$nome}' já existe. Pulando criação...\n";
    }

    echo "\n✅ Seed concluído! Você pode logar com '{$email}' (senha: 123456).\n";

} catch (PDOException $e) {
    echo "❌ Erro durante o seed: " . $e->getMessage() . "\n";
}
