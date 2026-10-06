<?php
/**
 * Command: Migration
 *
 * Auto-discovered by the LavaLust CLI.
 * No registration needed — just drop this file in app/commands/.
 */
class Migration
{
    /**
     * The CLI command name.
     * Usage: php lava migration [action] [name]
     */
    public static $command = 'migration';

    /** Short description shown in php lava help */
    public static $description = 'Run database migrations';

    public static $arguments = [
        '[action]' => 'Action: run, create-migration, rollback, rollback-all, refresh, status',
        '[name]'   => 'Migration class name for create-migration',
    ];

    protected static $route_map = [
        'run'              => 'migrate',
        'create-migration' => 'create-migration',
        'rollback'         => 'rollback',
        'rollback-all'     => 'rollback-all',
        'refresh'          => 'refresh',
        'status'           => 'status',
    ];

    /**
     * Command entry point.
     *
     * LavaLust's command dispatcher passes only the first positional argument
     * and flags, so the optional migration name is read from argv.
     */
    public function handle($input = null, array $flags = [])
    {
        $action = $input ?? 'run';

        if (!isset(static::$route_map[$action])) {
            echo danger("Unknown migration action: \"{$action}\"") . PHP_EOL;
            echo 'Available actions: '
                . implode(', ', array_keys(static::$route_map))
                . PHP_EOL;
            exit(1);
        }

        if ($action === 'create-migration') {
            global $argv;
            $name = $flags['name'] ?? ($argv[3] ?? null);

            if (!is_string($name) || !preg_match('/^[A-Za-z0-9_-]+$/', $name)) {
                echo danger('A valid migration name is required.') . PHP_EOL;
                echo 'Example: php lava migration create-migration create_users_table'
                    . PHP_EOL;
                exit(1);
            }

            $route = 'create-migration/' . $name;
        } else {
            $route = static::$route_map[$action];
        }

        $index = PUBLIC_DIR . DIRECTORY_SEPARATOR . 'index.php';
        if (!file_exists($index)) {
            echo danger("index.php not found at: {$index}") . PHP_EOL;
            exit(1);
        }

        $command = sprintf(
            '%s %s %s',
            escapeshellarg(PHP_BINARY),
            escapeshellarg($index),
            escapeshellarg($route)
        );
        passthru($command, $exit_code);
        exit($exit_code);
    }
}
