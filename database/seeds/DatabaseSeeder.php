<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UsersTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(AccountChecklistStatusTableSeeder::class);
        $this->call(AccountSoaStatusTableSeeder::class);
        $this->call(AccountStatusTableSeeder::class);
        $this->call(UserAccessTableSeeder::class);
        $this->call(ClientRelationTableSeeder::class);
        $this->call(DeductionLocationTableSeeder::class);
        $this->call(DeductionTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(EmploymentStatusTableSeeder::class);
        $this->call(CivilStatusTableSeeder::class);
        $this->call(ReleaseScheduleStatusTableSeeder::class);
        $this->call(IndustryTableSeeder::class);
        $this->call(IdentificationListTableSeeder::class);
        $this->call(LoanTypeTableSeeder::class);
        $this->call(LoanAmountTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(BarangayTableSeeder::class);
        $this->call(UnitMeasureTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(LoanProcessTableSeeder::class);
        $this->call(AmmortizationStatusTableSeeder::class);
        $this->call(IndustryModuleSeeder::class);
        $this->call(IndustryUserAccessSeeder::class);
    }
}
