<?php

namespace App\Bundle\Perception\Generator\Handler;

use App\Bundle\Perception\Entity\Perception;
use App\Bundle\Perception\Generator\Command\UpdatePerceptionCommand;
use App\Bundle\Perception\Repository\PerceptionRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdatePerceptionHandler
{
    /** @var EntityManagerInterface */
    private $em;
    /** @var PerceptionRepository */
    private $perceptionRepository;

    public function __construct(
        EntityManagerInterface $em,
        PerceptionRepository $perceptionRepository
    )
    {
        $this->em = $em;
        $this->perceptionRepository = $perceptionRepository;
    }

    public function handle(UpdatePerceptionCommand $perceptionCommand): void
    {
        $perceptionDTO = $perceptionCommand->getPerceptionDTO();
        $coordinatesDTO = $perceptionCommand->getCoordinatesDTO();

        /** @var null|Perception $perception */
        $perception = $this->perceptionRepository
            ->findOneBy(['formatted' => $perceptionDTO->getFormatted()]);

        if ($perception !== null) {
            $perception->setLat($coordinatesDTO->getLatitude());
            $perception->setLng($coordinatesDTO->getLongitude());
            $perception->updateTimestamps();

            $this->em->persist($perception);
            $this->em->flush();
        }
    }
}