<?php
namespace Learning\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VideoExtractCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('video:extract')
            ->setDescription('Extrait portion vidéo où les chats mangent')
            // ->addArgument('name', InputArgument::OPTIONAL, 'Qui voulez vous saluer??')
            // ->addOption('yell', null, InputOption::VALUE_NONE, 'Si définie, la tâche criera en majuscules')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $extractor = $this->getContainer()->get('learning_core.video_extractor');
        $extractor->process();

        foreach ($extractor->getErrors() as $error) {
            $output->writeln($error);
        }
    }
}