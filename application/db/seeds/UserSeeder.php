<?php
use Phinx\Seed\AbstractSeed;
use Brilliant\Users\BUser;
use Brilliant\Users\BUsers;
use Application\Companies\Company;
use Application\Companies\Companies;

class UserSeeder extends AbstractSeed {
	/**
	 * Create User
	 * @param $name string
	 * @param $email string
	 * @param $password string
	 * @param $status string
	 * @param $isAdmin string
	 * @return BUser|null
	 */
	protected function createUser($name, $email, $password, $status, $isAdmin) {
		$user = new BUser();
		$user->name = $name;
		$user->email = $email;
		$user->status = $status;
		$user->isadmin = $isAdmin;
		$user->setpassword($password);
		$r = $user->saveToDB();
		if (empty($r)) {
			return NULL;
		}
		return $user;
	}

	/**
	 * Create company
	 *
	 * @param $name
	 * @param $status
	 * @param $published
	 * @param $director
	 * @return Company|null
	 */
	protected function createCompany($name, $status, $published, $director) {
		$company = new Company();
		$company->name = $name;
		$company->status = $status;
		$company->published = $published;
		$company->director = $director;
		$r = $company->saveToDB();
		if (empty($r)) {
			return NULL;
		}
		return $company;
	}

	/**
	 * Run Method.
	 */
	public function run() {
		$options = $this->getAdapter()->getOptions();
		define('MYSQL_DB_HOST', $options['host']);
		define('MYSQL_DB_USERNAME', $options['user']);
		define('MYSQL_DB_PASSWORD', $options['pass']);
		define('MYSQL_DB_NAME', $options['name']);
		//getFaker
		$faker = \Faker\Factory::create();
		//Truncate Table
		$bCompanies = Companies::getInstance();
		$bCompanies->truncateAll();
		$bUsers = BUsers::getInstance();
		$bUsers->truncateAll();
		//Administrator
		$this->createUser('Administrator', 'admin@financello.com', '0000', 'P', 'Y');
		//Company #1
		$user11 = $this->createUser($faker->name, 'boss@company1.com', '0000', 'P', 'N');
		$this->createUser($faker->name, 'accountant@company1.com', '0000', 'P', 'N');
		$this->createUser($faker->name, 'mgr1@company1.com', '0000', 'P', 'N');
		$this->createUser($faker->name, 'mgr2@company1.com', '0000', 'P', 'N');
		$this->createCompany($faker->company, 'C', 'P', $user11->id);
		//Company #1
		$user21 = $this->createUser($faker->name, 'boss@company2.com', '0000', 'P', 'N');
		$this->createUser($faker->name, 'accountant@company2.com', '0000', 'P', 'N');
		$this->createUser($faker->name, 'mgr1@company2.com', '0000', 'P', 'N');
		$this->createUser($faker->name, 'mgr2@company2.com', '0000', 'P', 'N');
		$this->createCompany($faker->company, 'C', 'P', $user21->id);
	}
}
