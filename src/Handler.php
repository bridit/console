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
   * @param null $event
   * @param null $context
   * @throws Exception
   */
  public function handle($event = null, $context = null)
  {

    define('APP_HANDLER_TYPE', 'cli');

    parent::handle($event, $context);

    $this->run();

  }

  /**
   * @throws Exception
   */
  protected function run()
  {

    $console = new ConsoleApplication;

    $commands = array_merge($this->commands, require path('/routes/console.php'));

    foreach ($commands as $command)
    {
      $console->add(new $command);
    }

    $console->run();

  }

}
