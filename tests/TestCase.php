<?phpc

class TestCase extends Orchestra\Testbench\TestCase {


	/**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();
 
        $this->prepareForTests();
    }
 
    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;
 
        $testEnvironment = 'testing';
 
        return require __DIR__.'/../../../../bootstrap/start.php';
    }
 
    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     */
    private function prepareForTests()
    {
        Artisan::call('migrate', array('--package' => 'machuga/authority-l4'));
        Artisan::call('migrate', array('--workbench' => 'lukaswhite/laravel-cms'));
        Artisan::call('migrate');        
        Artisan::call('db:seed');
        Mail::pretend(true);
    }

    public function assertValidationFailedOnField($model, $field)
    {
        return $this->assertTrue(in_array($field, array_keys($model->errors()->getMessages())));
    }

}
