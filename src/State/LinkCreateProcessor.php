<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Links;
use App\Service\ShortCodeGeneratorService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class LinkCreateProcessor implements ProcessorInterface
{

    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $processor,
        private ShortCodeGeneratorService $shortCodeGenerator,
        private Security $security,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if (!$data instanceof Links) {
            return $data;
        }
        $user = $this->security->getUser();

        $data->setOwner($user);
        $data->setShortCode($this->shortCodeGenerator->generate());

        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}
