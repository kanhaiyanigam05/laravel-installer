<?php

namespace Kanhaiyanigam05\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Kanhaiyanigam05\LaravelInstaller\Events\LaravelInstallerFinished;
use Kanhaiyanigam05\LaravelInstaller\Helpers\EnvironmentManager;
use Kanhaiyanigam05\LaravelInstaller\Helpers\FinalInstallManager;
use Kanhaiyanigam05\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param  \Kanhaiyanigam05\LaravelInstaller\Helpers\InstalledFileManager  $fileManager
     * @param  \Kanhaiyanigam05\LaravelInstaller\Helpers\FinalInstallManager  $finalInstall
     * @param  \Kanhaiyanigam05\LaravelInstaller\Helpers\EnvironmentManager  $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
