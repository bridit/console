<?php declare(strict_types=1);

namespace Brid\Console;

use Exception;
use Symfony\Component\Console\Application as ConsoleApplication;

class Handler extends \Brid\Core\Handlers\Handler
{

  protected array $commands = [
    //
  ];

  /**
   * @inheritDoc
   */
  protected function boot(string $basePath = null): static
  {
    define('APP_HANDLER_TYPE', 'cli');

    return parent::boot($basePath);
  }

  /**
   * @param null $event
   * @param null $context
   * @return int
   * @throws Exception
   */
  public function handle($event = null, $context = null)
  {
    parent::handle($event, $context);

    return $this->run();
  }

  /**
   * @return int
   * @throws Exception
   */
  protected function run(): int
  {
    $console = new ConsoleApplication;

    $commands = array_merge($this->commands, require path('/routes/console.php'));

    foreach ($commands as $command)
    {
      $console->add(new $command);
    }

    return $console->run();
  }

}
