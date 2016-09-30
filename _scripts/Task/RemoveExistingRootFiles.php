<?php
/**
 * Bright Nucleus Boilerplate.
 *
 * @package   BrightNucleus\Boilerplate
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\Boilerplate\Scripts\Task;

use BrightNucleus\Boilerplate\Scripts\SetupHelper;
use Composer\Util\Filesystem;
use Exception;

/**
 * Class RemoveExistingRootFiles.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\Boilerplate\Scripts\Task
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class RemoveExistingRootFiles extends AbstractTask
{

    /**
     * Complete the setup task.
     *
     * @since 0.1.0
     *
     * @return void
     */
    public function complete()
    {
        $filesystem = new Filesystem;
        foreach ($this->getRootFiles() as $file) {
            try {
                $filesystem->remove(SetupHelper::getFile($file));
            } catch (Exception $exception) {
                $this->io->writeError(
                    sprintf(
                        'Could not remove file "%1$s". Reason: %2$s',
                        SetupHelper::getFile($file),
                        $exception->getMessage()
                    )
                );
            }
        }
    }

    /**
     * Get an array of file names for all the files that need to be removed from the project root.
     *
     * @since 0.1.0
     *
     * @return array Array of file names.
     */
    protected function getRootFiles()
    {
        return [
            'CHANGELOG.md',
            'LICENSE',
            'README.md',
            'composer.json',
            'composer.lock',
        ];
    }
}
