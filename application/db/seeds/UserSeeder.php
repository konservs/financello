<?php
use Phinx\Seed\AbstractSeed;
use Brilliant\Users\BUser;
use Brilliant\Users\BUsers;
use Application\Companies\Company;
use Application\Companies\Companies;
use Application\Companies\CompanyUser;
use Application\Companies\CompanyUsers;

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
	 * Append user to company
	 *
	 * @param $userId int
	 * @param $companyId int
	 * @param $accessFlags string[]
	 * @return CompanyUser|null
	 */
	protected function appendUserToCompany($userId, $companyId, $accessFlags) {
		$companyUser = new CompanyUser();
		$companyUser->user = $userId;
		$companyUser->company = $companyId;
		foreach ($accessFlags as $flag) {
			$companyUser->setAccessFlag($flag, 1);
		}
		$r = $companyUser->saveToDB();
		if (empty($r)) {
			return NULL;
		}
		return $companyUser;
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
		//
		$db = \Brilliant\BFactory::getDBO();
		$db->query('SET FOREIGN_KEY_CHECKS=0');
		//Truncate Table
		$bCompaniesUsers = CompanyUsers::getInstance();
		$bCompaniesUsers->truncateAll();
		$bCompanies = Companies::getInstance();
		$bCompanies->truncateAll();
		$bUsers = BUsers::getInstance();
		$bUsers->truncateAll();
		//Administrator
		$this->createUser('Administrator', 'admin@financello.com', '0000', 'P', 'Y');
		//Company #1
		$user11 = $this->createUser($faker->name, 'boss@company1.com', '0000', 'P', 'N');
		$user12 = $this->createUser($faker->name, 'accountant@company1.com', '0000', 'P', 'N');
		$user13 = $this->createUser($faker->name, 'mgr1@company1.com', '0000', 'P', 'N');
		$user14 = $this->createUser($faker->name, 'mgr2@company1.com', '0000', 'P', 'N');
		$company1 = $this->createCompany($faker->company, 'C', 'P', $user11->id);
		$this->appendUserToCompany($user12->id, $company1->id, Companies::getAllFlags());
		$this->appendUserToCompany($user13->id, $company1->id, Companies::getAllFlags());
		$this->appendUserToCompany($user14->id, $company1->id, Companies::getAllFlags());
		//Company #1
		$user21 = $this->createUser($faker->name, 'boss@company2.com', '0000', 'P', 'N');
		$user22 = $this->createUser($faker->name, 'accountant@company2.com', '0000', 'P', 'N');
		$user23 = $this->createUser($faker->name, 'mgr1@company2.com', '0000', 'P', 'N');
		$user24 = $this->createUser($faker->name, 'mgr2@company2.com', '0000', 'P', 'N');
		$company2 = $this->createCompany($faker->company, 'C', 'P', $user21->id);
		$this->appendUserToCompany($user22->id, $company2->id, Companies::getAllFlags());
		$this->appendUserToCompany($user23->id, $company2->id, Companies::getAllFlags());
		$this->appendUserToCompany($user24->id, $company2->id, Companies::getAllFlags());
	}
}
