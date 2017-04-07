<?php
use Phinx\Seed\AbstractSeed;
use Brilliant\Users\BUser;
use Brilliant\Users\BUsers;

class UserSeeder extends AbstractSeed {
	/**
	 * Create User
	 * @param $name string
	 * @param $email string
	 * @param $password string
	 * @param $status string
	 * @param $isAdmin string
	 * @return bool
	 */
	protected function createUser($name, $email, $password, $status, $isAdmin){
		$user1 = new BUser();
		$user1->name = $name;
		$user1->email = $email;
		$user1->status = $status;
		$user1->isadmin = $isAdmin;
		$user1->setpassword($password);
		return $user1->saveToDB();
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
		//Truncate Table
		$bUsers = BUsers::getInstance();
		$bUsers->truncateAll();
		//Administrator
		$this->createUser('Administrator','admin@financello.com','0000','P','Y');
		//Company #1
		$this->createUser('Boss #1','boss@company1.com','0000','P','N');
		$this->createUser('Accountant #1','accountant@company1.com','0000','P','N');
		$this->createUser('Manager #1','mgr1@company1.com','0000','P','N');
		$this->createUser('Manager #2','mgr2@company1.com','0000','P','N');
	}
}
