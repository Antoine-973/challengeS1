<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BreedFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $backyardBirds = $manager->getRepository(Species::class)->findOneBy(['name' => 'Oiseaux de basses cours']);

        $duck = (new Breed())
            ->setName('Canard')
            ->setDescription('Le Canard est un oiseau aquatiques ansériformes, au cou court, au large bec jaune aplati, aux très courtes pattes palmées et aux longues ailes pointues.')
            ->setSpecies($backyardBirds);

        $manager->persist($duck);

        $rooster = (new Breed())
            ->setName('Coq')
            ->setDescription('Le coq est un oiseau galliforme de la famille des Phasianidés. Il est le mâle de la poule.')
            ->setSpecies($backyardBirds);

        $manager->persist($rooster);

        $goatSpecies = $manager->getRepository(Species::class)->findOneBy(['name' => 'Caprin']);

        $goat = (new Breed())
            ->setName('Chèvre')
            ->setDescription('La chèvre est un mammifère ruminant domestique de la famille des Caprins. Elle est originaire d\'Asie et d\'Afrique.')
            ->setSpecies($goatSpecies);

        $manager->persist($goat);

        $sheepSpecies = $manager->getRepository(Species::class)->findOneBy(['name' => 'Ovin']);

        $sheep = (new Breed())
            ->setName('Mouton')
            ->setDescription('Le mouton est un mammifère ruminant domestique de la famille des Bovins. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($sheepSpecies);

        $manager->persist($sheep);

        $ram = (new Breed())
            ->setName('Bélier')
            ->setDescription('Le bélier est le mâle de la brebis. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($sheepSpecies);

        $manager->persist($ram);

        $pigSpecies = $manager->getRepository(Species::class)->findOneBy(['name' => 'Porc']);

        $pig = (new Breed())
            ->setName('Cochon')
            ->setDescription('Le cochon est un mammifère domestique de la famille des Suidae. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($pigSpecies);

        $manager->persist($pig);

        $equine = $manager->getRepository(Species::class)->findOneBy(['name' => 'Equide']);

        $horse = (new Breed())
            ->setName('Cheval')
            ->setDescription('Le cheval est un mammifère équin domestique de la famille des Équidés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($equine);

        $manager->persist($horse);

        $donkey = (new Breed())
            ->setName('Âne')
            ->setDescription('L\'âne est un mammifère équin domestique de la famille des Équidés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($equine);

        $manager->persist($donkey);

        $pony = (new Breed())
            ->setName('Poney')
            ->setDescription('Le poney est un mammifère équin domestique de la famille des Équidés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($equine);

        $manager->persist($pony);

        $nac = $manager->getRepository(Species::class)->findOneBy(['name' => 'NAC']);

        $rabbit = (new Breed())
            ->setName('Lapin')
            ->setDescription('Le lapin est un mammifère de la famille des Léporidés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($nac);

        $manager->persist($rabbit);

        $guineaPig = (new Breed())
            ->setName('Cochon d\'Inde')
            ->setDescription('Le cochon d\'Inde est un mammifère de la famille des Caviidés. Il est originaire d\'Amérique du Sud.')
            ->setSpecies($nac);

        $manager->persist($guineaPig);

        $degus = (new Breed())
            ->setName('Octodon')
            ->setDescription("L'octodon est un mammifère de la famille des Caviidés. Il est originaire d\'Amérique du Sud.")
            ->setSpecies($nac);

        $manager->persist($degus);

        $hamster = (new Breed())
            ->setName('Hamster')
            ->setDescription('Le hamster est un mammifère de la famille des Cricétidés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($nac);

        $manager->persist($hamster);

        $rat = (new Breed())
            ->setName('Rat')
            ->setDescription('Le rat est un mammifère de la famille des Muridés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($nac);

        $manager->persist($rat);

        $mouse = (new Breed())
            ->setName('Souris')
            ->setDescription('La souris est un mammifère de la famille des Muridés. Il est originaire d\'Asie et d\'Europe.')
            ->setSpecies($nac);

        $manager->persist($mouse);

        $cat = $manager->getRepository(Species::class)->findOneBy(['name' => 'Chat']);

        $angora = (new Breed())
            ->setName('Angora')
            ->setDescription("L'angora est un chat domestique de la famille des Felidae. Il est originaire d'Anatolie.")
            ->setSpecies($cat);

        $manager->persist($angora);

        $crossbreed = (new Breed())
            ->setName('Croise / Autre')
            ->setDescription('Croisé ou autre')
            ->setSpecies($cat);

        $manager->persist($crossbreed);

        $europeen = (new Breed())
            ->setName('Européen')
            ->setDescription("L'européen est un chat domestique de la famille des Felidae. Il est originaire d'Europe.")
            ->setSpecies($cat);

        $manager->persist($europeen);

        $maincoon = (new Breed())
            ->setName('Maincoon')
            ->setDescription("Le maincoon est un chat domestique de la famille des Felidae. Il est originaire d'Amérique du Nord.")
            ->setSpecies($cat);

        $manager->persist($maincoon);

        $persan = (new Breed())
            ->setName('Persan')
            ->setDescription("Le persan est un chat domestique de la famille des Felidae. Il est originaire d'Asie.")
            ->setSpecies($cat);

        $manager->persist($persan);

        $sacreDeBirmanie = (new Breed())
            ->setName('Sacré de Birmanie')
            ->setDescription("Le sacré de Birmanie est un chat domestique de la famille des Felidae. Il est originaire d'Asie.")
            ->setSpecies($cat);

        $manager->persist($sacreDeBirmanie);

        $scottishFold = (new Breed())
            ->setName('Scottish Fold')
            ->setDescription("Le scottish fold est un chat domestique de la famille des Felidae. Il est originaire d'Europe.")
            ->setSpecies($cat);

        $manager->persist($scottishFold);

        $siamois = (new Breed())
            ->setName('Siamois')
            ->setDescription("Le siamois est un chat domestique de la famille des Felidae. Il est originaire d'Asie.")
            ->setSpecies($cat);

        $manager->persist($siamois);

        $dog = $manager->getRepository(Species::class)->findOneBy(['name' => 'Chien']);

        $americanAkita = (new Breed())
            ->setName('Akita Américain')
            ->setDescription("L'akita américain est un chien domestique de la famille des Canidés. Il est originaire d'Amérique du Nord.")
            ->setSpecies($dog);

        $manager->persist($americanAkita);

        $inuAkita = (new Breed())
            ->setName('Akita Inu')
            ->setDescription("L'akita inu est un chien domestique de la famille des Canidés. Il est originaire du Japon.")
            ->setSpecies($dog);

        $manager->persist($inuAkita);

        $americanBully = (new Breed())
            ->setName('American Bully')
            ->setDescription("L'american bully est un chien domestique de la famille des Canidés. Il est originaire d'Amérique du Nord.")
            ->setSpecies($dog);

        $manager->persist($americanBully);

        $americanStaffordshire = (new Breed())
            ->setName('American Staffordshire')
            ->setDescription("L'american staffordshire est un chien domestique de la famille des Canidés. Il est originaire d'Amérique du Nord.")
            ->setSpecies($dog);

        $manager->persist($americanStaffordshire);

        $anglo = (new Breed())
            ->setName('Anglo-Français de Petite Vénerie')
            ->setDescription("L'anglo-français de petite vénerie est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($anglo);

        $ariegeois = (new Breed())
            ->setName('Ariegeois')
            ->setDescription("L'ariegeois est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($ariegeois);

        $basset = (new Breed())
            ->setName('Basset')
            ->setDescription("Le basset est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($basset);

        $beagle = (new Breed())
            ->setName('Beagle')
            ->setDescription("Le beagle est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($beagle);

        $beardedCollie = (new Breed())
            ->setName('Bearded Collie')
            ->setDescription("Le bearded collie est un chien domestique de la famille des Canidés. Il est originaire d'Ecosse.")
            ->setSpecies($dog);

        $manager->persist($beardedCollie);

        $berger = (new Breed())
            ->setName('Berger')
            ->setDescription("Le berger est un chien domestique de la famille des Canidés. Il est originaire d'Europe.")
            ->setSpecies($dog);

        $manager->persist($berger);

        $bergerAllemand = (new Breed())
            ->setName('Berger Allemand')
            ->setDescription("Le berger allemand est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
            ->setSpecies($dog);

        $manager->persist($bergerAllemand);

        $bergerAustralian = (new Breed())
            ->setName('Berger Australien')
            ->setDescription("Le berger australien est un chien domestique de la famille des Canidés. Il est originaire d'Australie.")
            ->setSpecies($dog);

        $manager->persist($bergerAustralian);

        $bergerBelge = (new Breed())
            ->setName('Berger Belge')
            ->setDescription("Le berger belge est un chien domestique de la famille des Canidés. Il est originaire de Belgique.")
            ->setSpecies($dog);

        $manager->persist($bergerBelge);

        $bergerBlancSuisse = (new Breed())
            ->setName('Berger Blanc Suisse')
            ->setDescription("Le berger blanc suisse est un chien domestique de la famille des Canidés. Il est originaire de Suisse.")
            ->setSpecies($dog);

        $manager->persist($bergerBlancSuisse);

        $bergerAnatolie = (new Breed())
            ->setName('Berger d\'Anatolie')
            ->setDescription("Le berger d'anatolie est un chien domestique de la famille des Canidés. Il est originaire de Turquie.")
            ->setSpecies($dog);

        $manager->persist($bergerAnatolie);

        $bergerAsieCentrale = (new Breed())
            ->setName('Berger d\'Asie Centrale')
            ->setDescription("Le berger d'asie centrale est un chien domestique de la famille des Canidés. Il est originaire d'Asie Centrale.")
            ->setSpecies($dog);

        $manager->persist($bergerAsieCentrale);

        $bergerDeBeauce = (new Breed())
            ->setName('Berger de Beauce')
            ->setDescription("Le berger de beauce est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($bergerDeBeauce);

        $bergerDesPyrenees = (new Breed())
            ->setName('Berger des Pyrénées')
            ->setDescription("Le berger des pyrénées est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($bergerDesPyrenees);

        $bergerDesShetland = (new Breed())
            ->setName('Berger des Shetland')
            ->setDescription("Le berger des shetland est un chien domestique de la famille des Canidés. Il est originaire d'Ecosse.")
            ->setSpecies($dog);

        $manager->persist($bergerDesShetland);

        $bergerDuCaucase = (new Breed())
            ->setName('Berger du Caucase')
            ->setDescription("Le berger du caucase est un chien domestique de la famille des Canidés. Il est originaire du Caucase.")
            ->setSpecies($dog);

        $manager->persist($bergerDuCaucase);

        $bergerHollandais = (new Breed())
            ->setName('Berger Hollandais')
            ->setDescription("Le berger hollandais est un chien domestique de la famille des Canidés. Il est originaire des Pays-Bas.")
            ->setSpecies($dog);

        $manager->persist($bergerHollandais);

        $bergerPicard = (new Breed())
            ->setName('Berger Picard')
            ->setDescription("Le berger picard est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($bergerPicard);

        $bichon = (new Breed())
            ->setName('Bichon')
            ->setDescription("Le bichon est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($bichon);

        $bobtail = (new Breed())
            ->setName('Bobtail')
            ->setDescription("Le bobtail est un chien domestique de la famille des Canidés. Il est originaire du Japon.")
            ->setSpecies($dog);

        $manager->persist($bobtail);

        $borderCollie = (new Breed())
            ->setName('Border Collie')
            ->setDescription("Le border collie est un chien domestique de la famille des Canidés. Il est originaire d'Ecosse.")
            ->setSpecies($dog);

        $manager->persist($borderCollie);

        $borderTerrier = (new Breed())
            ->setName('Border Terrier')
            ->setDescription("Le border terrier est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($borderTerrier);

        $bouledogueAmericain = (new Breed())
            ->setName('Bouledogue Américain')
            ->setDescription("Le bouledogue américain est un chien domestique de la famille des Canidés. Il est originaire des Etats-Unis.")
            ->setSpecies($dog);

        $manager->persist($bouledogueAmericain);

        $bouledogueAnglais = (new Breed())
            ->setName('Bouledogue Anglais')
            ->setDescription("Le bouledogue anglais est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($bouledogueAnglais);

        $bouledogueFrancais = (new Breed())
            ->setName('Bouledogue Français')
            ->setDescription("Le bouledogue français est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($bouledogueFrancais);

        $bouvierBernois = (new Breed())
            ->setName('Bouvier Bernois')
            ->setDescription("Le bouvier bernois est un chien domestique de la famille des Canidés. Il est originaire de Suisse.")
            ->setSpecies($dog);

        $manager->persist($bouvierBernois);

        $bouvierAustralian = (new Breed())
            ->setName('Bouvier Australien')
            ->setDescription("Le bouvier australien est un chien domestique de la famille des Canidés. Il est originaire d'Australie.")
            ->setSpecies($dog);

        $manager->persist($bouvierAustralian);

        $boxer = (new Breed())
            ->setName('Boxer')
            ->setDescription("Le boxer est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
            ->setSpecies($dog);

        $manager->persist($boxer);

        $braque = (new Breed())
            ->setName('Braque')
            ->setDescription("Le braque est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($braque);

        $brunoDuJura = (new Breed())
            ->setName('Bruno du Jura')
            ->setDescription("Le bruno du jura est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($brunoDuJura);

        $bullTerrier = (new Breed())
            ->setName('Bull Terrier')
            ->setDescription("Le bull terrier est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($bullTerrier);

        $cairnTerrier = (new Breed())
            ->setName('Cairn Terrier')
            ->setDescription("Le cairn terrier est un chien domestique de la famille des Canidés. Il est originaire d'Ecosse.")
            ->setSpecies($dog);

        $manager->persist($cairnTerrier);

        $caneCorso = (new Breed())
            ->setName('Cane Corso')
            ->setDescription("Le cane corso est un chien domestique de la famille des Canidés. Il est originaire d'Italie.")
            ->setSpecies($dog);

        $manager->persist($caneCorso);

        $caniche = (new Breed())
            ->setName('Caniche')
            ->setDescription("Le caniche est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
            ->setSpecies($dog);

        $manager->persist($caniche);

        $carlin = (new Breed())
            ->setName('Carlin')
            ->setDescription("Le carlin est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($carlin);

        $cavalierKingCharles = (new Breed())
            ->setName('Cavalier King Charles')
            ->setDescription("Le cavalier king charles est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($cavalierKingCharles);

        $chienCorse = (new Breed())
            ->setName('Chien Corse')
            ->setDescription("Le chien corse est un chien domestique de la famille des Canidés. Il est originaire de France.")
            ->setSpecies($dog);

        $manager->persist($chienCorse);

        $chienLoupTcheque = (new Breed())
            ->setName('Chien Loup Tchèque')
            ->setDescription("Le chien loup tchèque est un chien domestique de la famille des Canidés. Il est originaire de Tchéquie.")
            ->setSpecies($dog);

        $manager->persist($chienLoupTcheque);

        $chihuahua = (new Breed())
            ->setName('Chihuahua')
            ->setDescription("Le chihuahua est un chien domestique de la famille des Canidés. Il est originaire du Mexique.")
            ->setSpecies($dog);

        $manager->persist($chihuahua);

        $cokerAnglais = (new Breed())
            ->setName('Cocker Anglais')
            ->setDescription("Le cocker anglais est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
            ->setSpecies($dog);

        $manager->persist($cokerAnglais);

        $colley = (new Breed())
           ->setName('Colley')
           ->setDescription("Le colley est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

       $cotonTulear = (new Breed())
           ->setName('Coton de Tuléar')
           ->setDescription("Le coton de tuléar est un chien domestique de la famille des Canidés. Il est originaire de Madagascar.")
           ->setSpecies($dog);

        $manager->persist($cotonTulear);

       $dalmatien = (new Breed())
           ->setName('Dalmatien')
           ->setDescription("Le dalmatien est un chien domestique de la famille des Canidés. Il est originaire de Croatie.")
           ->setSpecies($dog);

        $manager->persist($dalmatien);

       $dobermann = (new Breed())
           ->setName('Dobermann')
           ->setDescription("Le dobermann est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($dobermann);

       $dogue = (new Breed())
           ->setName('Dogue')
           ->setDescription("Le dogue est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($dogue);

       $dogueAllemand = (new Breed())
           ->setName('Dogue Allemand')
           ->setDescription("Le dogue allemand est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($dogueAllemand);

       $dogueArgentin = (new Breed())
           ->setName('Dogue Argentin')
           ->setDescription("Le dogue argentin est un chien domestique de la famille des Canidés. Il est originaire d'Argentine.")
           ->setSpecies($dog);

        $manager->persist($dogueArgentin);

       $epagneul = (new Breed())
           ->setName('Epagneul')
           ->setDescription("L'épagneul est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($epagneul);

       $epagneulBreton = (new Breed())
           ->setName('Epagneul Breton')
           ->setDescription("L'épagneul breton est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($epagneulBreton);

       $epagneulNain = (new Breed())
           ->setName('Epagneul Nain')
           ->setDescription("L'épagneul nain est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($epagneulNain);

       $eurasier = (new Breed())
           ->setName('Eurasier')
           ->setDescription("L'eurasier est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($eurasier);

       $foxTerrierPoilDur = (new Breed())
           ->setName('Fox Terrier à poil dur')
           ->setDescription("Le fox terrier à poil dur est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($foxTerrierPoilDur);

       $foxTerrierPoilLisse = (new Breed())
           ->setName('Fox Terrier à poil lisse')
           ->setDescription("Le fox terrier à poil lisse est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($foxTerrierPoilLisse);

       $goldenRetriever = (new Breed())
           ->setName('Golden Retriever')
           ->setDescription("Le golden retriever est un chien domestique de la famille des Canidés. Il est originaire d'Ecosse.")
           ->setSpecies($dog);

        $manager->persist($goldenRetriever);

       $huskySiberien = (new Breed())
           ->setName('Husky Sibérien')
           ->setDescription("Le husky sibérien est un chien domestique de la famille des Canidés. Il est originaire de Russie.")
           ->setSpecies($dog);

        $manager->persist($huskySiberien);

       $jackRusselTerrier = (new Breed())
           ->setName('Jack Russel Terrier')
           ->setDescription("Le jack russel terrier est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($jackRusselTerrier);

       $labradorRetriever = (new Breed())
           ->setName('Labrador Retriever')
           ->setDescription("Le labrador retriever est un chien domestique de la famille des Canidés. Il est originaire du Canada.")
           ->setSpecies($dog);

        $manager->persist($labradorRetriever);

       $levrier = (new Breed())
           ->setName('Levrier')
           ->setDescription("Le levrier est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($levrier);

       $malamuteAlaska = (new Breed())
           ->setName("Malamute d'Alaska")
           ->setDescription("Le malamute d'Alaska est un chien domestique de la famille des Canidés. Il est originaire d'Alaska.")
           ->setSpecies($dog);

        $manager->persist($malamuteAlaska);

        $patou = (new Breed())
           ->setName('Patou')
           ->setDescription("Le patou est un chien domestique de la famille des Canidés. Il est originaire de France.")
           ->setSpecies($dog);

        $manager->persist($patou);

      $pekinois = (new Breed())
           ->setName('Pékinois')
           ->setDescription("Le pékinois est un chien domestique de la famille des Canidés. Il est originaire de Chine.")
           ->setSpecies($dog);

        $manager->persist($pekinois);

       $pinscherMoyen = (new Breed())
           ->setName('Pinscher Moyen')
           ->setDescription("Le pinscher moyen est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($pinscherMoyen);

       $pinscherNain = (new Breed())
           ->setName('Pinscher Nain')
           ->setDescription("Le pinscher nain est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($pinscherNain);

       $rottweiler = (new Breed())
           ->setName('Rottweiler')
           ->setDescription("Le rottweiler est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($rottweiler);

       $saintBernard = (new Breed())
           ->setName('Saint-Bernard')
           ->setDescription("Le saint-bernard est un chien domestique de la famille des Canidés. Il est originaire de Suisse.")
           ->setSpecies($dog);

        $manager->persist($saintBernard);

       $schnauzerMoyen = (new Breed())
           ->setName('Schnauzer Moyen')
           ->setDescription("Le schnauzer moyen est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($schnauzerMoyen);

       $setterAnglais = (new Breed())
           ->setName('Setter Anglais')
           ->setDescription("Le setter anglais est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($setterAnglais);

       $sharPei = (new Breed())
           ->setName('Shar Pei')
           ->setDescription("Le shar pei est un chien domestique de la famille des Canidés. Il est originaire de Chine.")
           ->setSpecies($dog);

        $manager->persist($sharPei);

       $shihTzu = (new Breed())
           ->setName('Shih Tzu')
           ->setDescription("Le shih tzu est un chien domestique de la famille des Canidés. Il est originaire de Chine.")
           ->setSpecies($dog);

        $manager->persist($shihTzu);

       $spitz = (new Breed())
           ->setName('Spitz')
           ->setDescription("Le spitz est un chien domestique de la famille des Canidés. Il est originaire de Scandinavie.")
           ->setSpecies($dog);

        $manager->persist($spitz);

       $staffie = (new Breed())
           ->setName('Staffie')
           ->setDescription("Le staffie est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($staffie);

       $staffordshireBullTerrier = (new Breed())
           ->setName('Staffordshire Bull Terrier')
           ->setDescription("Le staffordshire bull terrier est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($staffordshireBullTerrier);

       $teckel = (new Breed())
           ->setName('Teckel')
           ->setDescription("Le teckel est un chien domestique de la famille des Canidés. Il est originaire d'Allemagne.")
           ->setSpecies($dog);

        $manager->persist($teckel);

       $terrier = (new Breed())
           ->setName('Terrier')
           ->setDescription("Le terrier est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($terrier);

       $terrierDeBoston = (new Breed())
           ->setName('Terrier de Boston')
           ->setDescription("Le terrier de Boston est un chien domestique de la famille des Canidés. Il est originaire des États-Unis.")
           ->setSpecies($dog);

        $manager->persist($terrierDeBoston);

       $yorkshireTerrier = (new Breed())
           ->setName('Yorkshire Terrier')
           ->setDescription("Le yorkshire terrier est un chien domestique de la famille des Canidés. Il est originaire d'Angleterre.")
           ->setSpecies($dog);

        $manager->persist($yorkshireTerrier);

        $dogCrossbreed = (new Breed())
            ->setName('Croisé / Autre')
            ->setDescription('Croisé ou autre')
            ->setSpecies($dog);

        $manager->persist($dogCrossbreed);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SpeciesFixtures::class,
        ];
    }
}
