<?php

namespace App\Repository;

use ReflectionClass;

trait AuditTrait
{
    public function audits($entity)
    {
        $em = $this->getEntityManager();
        $name = (new ReflectionClass($entity))->getShortName();
        $auditRepository = $em->getRepository("\App\Entity\Loggable\\" . $name);
        $logs = $auditRepository->getLogEntries($entity);
        $props = [];
        foreach ($logs as $log) {
            $timeStamp = $log->getLoggedAt()->format('Y-m-d H:i:s');
            foreach ($log->getData() as $key => $value) {
                if (isset($props[$key])) {
                    $props[$key] = array_merge($props[$key], [$timeStamp => $value]);
                } else {
                    $props[$key] = [$timeStamp => $value];
                }
            }
        }
        return $props;
    }
}