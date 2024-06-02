<?php

namespace jiangjiangdev\WebmanAuto\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ContentResetCommand extends Command
{
    protected static $defaultName = 'auto:reset';
    protected static $defaultDescription = 'Auto reset all config';

    private const STUB_PATH = __DIR__ . '/../stubs/';
    private const CONFIG_STUB_PATH = __DIR__ . '/../stubs/config/';

    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'App name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        // Reset config
        // app.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'app.stub');
        $targetFolderPath = base_path() . "/config/app.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // container.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'container.stub');
        $targetFolderPath = base_path() . "/config/container.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // database.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'database.stub');
        $targetFolderPath = base_path() . "/config/database.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // process.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'process.stub');
        $targetFolderPath = base_path() . "/config/process.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // redis.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'redis.stub');
        $targetFolderPath = base_path() . "/config/redis.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // server.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'server.stub');
        $targetFolderPath = base_path() . "/config/server.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // session.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'session.stub');
        $targetFolderPath = base_path() . "/config/session.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // translation.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'translation.stub');
        $targetFolderPath = base_path() . "/config/translation.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // view.php
        $stubContent = file_get_contents(self::CONFIG_STUB_PATH . 'view.stub');
        $targetFolderPath = base_path() . "/config/view.php";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        // .env
        $stubContent = file_get_contents(self::STUB_PATH . 'env.stub');
        $targetFolderPath = base_path() . "/.env";
        // 替換名稱
        $stubContent = str_replace('{{name}}', $name, $stubContent);
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);
        
        // .gitignore
        $stubContent = file_get_contents(self::STUB_PATH . 'gitignore.stub');
        $targetFolderPath = base_path() . "/.gitignore";
        $this->checkAndCreateFile($targetFolderPath, $stubContent, true);

        return self::SUCCESS;
    }

    // 檢查並創建檔案
    private function checkAndCreateFile(string $fullPath, string $content, bool $force = false): bool
    {
        // 檢查檔案是否存在
        if (file_exists($fullPath) && !$force) {
            echo "File already exists: $fullPath\n";
            return false;
        }

        // 取得資料夾路徑
        $directoryPath = dirname($fullPath);

        // 檢查資料夾是否存在，如果不存在則創建資料夾
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
            echo "資料夾已創建: $directoryPath\n";
        }

        // 創建空檔案
        $fileHandle = fopen($fullPath, 'w');
        if ($fileHandle) {
            fwrite($fileHandle, $content);
            fclose($fileHandle);
            echo "檔案已創建: $fullPath\n";
        } else {
            echo "檔案創建失敗: $fullPath\n";
        }

        return true;
    }
}
