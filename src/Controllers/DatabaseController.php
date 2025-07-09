<?php

namespace Kanhaiyanigam05\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Kanhaiyanigam05\LaravelInstaller\Helpers\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param  DatabaseManager  $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelInstaller::final')
                         ->with(['message' => $response]);
    }
}
