<?php declare(strict_types=1);

namespace Brid\Console;

use Brid\Core\Foundation\Application;
use Exception;
use Symfony\Component\Console\Application as ConsoleApplication;

class Handler extends Application
{

  protected array $commands = [
    //
  ];

  /**
   * @throws Exception
   */
  public function handle()
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
