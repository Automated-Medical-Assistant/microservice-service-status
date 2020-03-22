<?php declare(strict_types=1);

namespace App\Console;

use MessageInfo\NumberAPIDataProvider;
use MessageInfo\NumberListAPIDataProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TestMessage extends Command
{
    protected static $defaultName = 'test:message';

    /**
     * @var \Symfony\Component\Messenger\MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    /**
     * @param \Symfony\Component\Messenger\MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Test message');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numberListDto = new NumberListAPIDataProvider();

        for ($i=0; $i < 10; $i++){
            $numberDto = new NumberAPIDataProvider();
            $numberDto->setNumber(time() . $i);
            $numberDto->setDoctorId(random_int(1,100));
            $numberDto->setCreationDate((new \DateTime())->format('Y-m-d H:i:s'));
            $numberDto->setStatus((bool)random_int(0,1));
            $numberListDto->addNumber($numberDto);
        }
        
        $this->messageBus->dispatch($numberListDto);

        return 0;
    }
}
