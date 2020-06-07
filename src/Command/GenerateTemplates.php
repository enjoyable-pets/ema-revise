<?php

namespace App\Command;

use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateTemplates extends Command
{
    public static string $name = 'generate:templates';

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct(self::$name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $sourceRepository = $this->em->getRepository(Source::class);
        $sources = $sourceRepository->findAll();
        /** @var Source $source */
        foreach ($sources as $source) {
            $content = $this->createContentTags($source->getContent());

            $this->generateHtmlFile($source->getId(), $content);
        }

        return 0;
    }

    private function createContentTags(string $content): string
    {
        $tags = [
            '&lt;' => '<',
            '&gt;' => '>',
            '&quot;' => '"',
            '/build/' => 'https://emapamokos.lt/build/',
        ];

        $find = array_keys($tags);
        $replace = array_values($tags);

        $content = str_replace($find, $replace, $content);

        return $content;
    }

    private function generateHtmlFile(int $id, string $content): void
    {
        $dir = dirname(__DIR__, 2).'/templates/generated/';
        $fileName = $id.'.html.twig';
        $filePath = $dir.$fileName;
        $file = fopen($filePath, 'wb+');
        file_put_contents($filePath, $content);
        fclose($file);
    }
}