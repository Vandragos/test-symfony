<?php

namespace App\Command;

use App\Entity\Article;
use App\Entity\Utilisateur;
use App\Entity\Boutique;
use App\Entity\Personnel;
use App\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'initialize',
    description: 'Add a short description for your command',
)]
class InitializeCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface  $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface  $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->note('Initialize app with default data');

        $boutique1 = new Boutique();
        $boutique1->setnom('Paris');
        $this->entityManager->persist($boutique1);

        $boutique2 = new Boutique();
        $boutique2->setnom('Nîmes');
        $this->entityManager->persist($boutique2);

        $article1 = new Article();
        $article1->setNom('Ski');
        $article1->setPrix(500);
        $this->entityManager->persist($article1);

        $article2 = new Article();
        $article2->setNom('Batons');
        $article2->setPrix(100);
        $this->entityManager->persist($article2);

        $article3 = new Article();
        $article3->setNom('Casque');
        $article3->setPrix(100);
        $this->entityManager->persist($article3);
        $this->entityManager->flush();

        //Stock boutique 1
        $stock = new Stock();
        $stock->setTarifLocationJour(25);
        $stock->setStock(10);
        $stock->setArticle($article1);
        $stock->setBoutique($boutique1);
        $this->entityManager->persist($stock);
        $this->entityManager->flush();

        $stock = new Stock();
        $stock->setTarifLocationJour(10);
        $stock->setStock(12);
        $stock->setArticle($article2);
        $stock->setBoutique($boutique1);
        $this->entityManager->persist($stock);
        $this->entityManager->flush();

    
        $user = new Utilisateur();
        $user->setLogin('admin1');
        $user->setPassword('admin1');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $personnel1 = new Personnel();
        $personnel1->setUtilisateur($user);
        $personnel1->setBoutique($boutique1);
        $this->entityManager->persist($personnel1);
        $this->entityManager->flush();

        $user = new Utilisateur();
        $user->setLogin('vendor1');
        $user->setPassword('vendor1');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $personnel2 = new Personnel();
        $personnel2->setUtilisateur($user);
        $personnel2->setBoutique($boutique2);
        $this->entityManager->persist($personnel2);
        $this->entityManager->persist($personnel2);
        $this->entityManager->flush();

        $user = new Utilisateur();
        $user->setLogin('admin2');
        $user->setPassword('admin2');
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $user = new Utilisateur();
        $user->setLogin('vendor2');
        $user->setPassword('vendor2');
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Application Initialized');

        return Command::SUCCESS;
    }
}
