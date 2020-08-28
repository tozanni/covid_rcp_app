<?php

namespace App\Entity\Loggable;

use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;
use Doctrine\ORM\Mapping as ORM;

/**
 * App\Entity\Loggable\ClottingTime
 *
 * @ORM\Table(
 *     name="clotting_time_log_entries",
 *     options={"row_format":"DYNAMIC"},
 *  indexes={
 *      @ORM\Index(name="clotting_time_log_class_lookup_idx", columns={"object_class"}),
 *      @ORM\Index(name="clotting_time_log_date_lookup_idx", columns={"logged_at"}),
 *      @ORM\Index(name="clotting_time_log_user_lookup_idx", columns={"username"}),
 *      @ORM\Index(name="clotting_time_log_version_lookup_idx", columns={"object_id", "object_class", "version"})
 *  }
 * )
 * @ORM\Entity(repositoryClass="Gedmo\Loggable\Entity\Repository\LogEntryRepository")
 */
class ClottingTime extends AbstractLogEntry
{
    /**
     * All required columns are mapped through inherited superclass
     */
}