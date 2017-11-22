<?php
/**
 * Template for "My company" page.
 *
 * @author: Andrii Birev
 */
defined('BEXEC')or die('No direct access!');
use \Brilliant\CMS\BLang;
$bRouter=\Application\BRouter::getInstance();

$urlCompanyAccounts = $bRouter->generateURL('finances',array('view'=>'accounts','lang'=>BLang::$langcode,'company'=>$this->company->id));
$urlCompanyOperations = $bRouter->generateURL('finances',array('view'=>'opgroups','lang'=>BLang::$langcode,'company'=>$this->company->id));
?>
<div id="companies_mycompany">
	<div class="header">
		<div class="form-group pull-right">
			<a class="btn btn-info" href="#"><i class="fa fa-plus"></i> Test1</a>
			<a class="btn btn-danger btn-delete disabled" href="#"><i class="fa fa-trash-o"></i> Test2</a>
		</div>

		<h1 class="page-header"><?php echo htmlspecialchars($this->company->name); ?></h1>
	</div>
	<?php $this->breadcrumbs->draw(); ?>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                Payments dashboard


            </div>
            <div class="col-lg-3 col-md-6">
                Payments dashboard - charts, etc.
            </div>
            <div class="col-lg-3 col-md-6">
                Projects dashboard - charts, etc.
            </div>
            <div class="col-lg-3 col-md-6">
                Stats - opened projects, closed projects, contacts count, etc.
            </div>
        </div>

	<hr/>

        <div class="row">
            <div class="col-lg-4 col-md-4">
                <h3>My Tasks</h3>
            </div>
            <div class="col-lg-4 col-md-4">
                <h3>Last Payments</h3>

                <div class="row">
                    <div class="col-lg-6 col-md-6">
		        <a class="btn btn-info btn-block" href="<?php echo $urlCompanyAccounts; ?>">Accounts</a>
                    </div>
                    <div class="col-lg-6 col-md-6">
        		<a class="btn btn-info btn-block" href="<?php echo $urlCompanyOperations; ?>">Operations</a>
                    </div>
                </div>


            </div>
            <div class="col-lg-4 col-md-4">
                <h3>Projects list</h3>
            </div>
        </div>


</div>
