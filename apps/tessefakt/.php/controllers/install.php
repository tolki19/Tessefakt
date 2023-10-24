<?php
namespace tessefakt\apps\tessefakt\controllers;
class system extends \tessefakt\controller{
	public function create_user(){
$this->dbs->current->query('insert into _users set id=default');
$user_id=$this->dbs->current->insert();
$this->dbs->current->query('insert into _user_emails set _user='.$user_id.',valid_from=curdate(),email="florian.kerl@gadvelop.de"');
$user_email=$this->dbs->current->insert();
$this->dbs->current->query('insert into _user_passwords set _user='.$user_id.',valid_from=curdate(),hash="'.$this->hash->create('Sxuyq783!').'",`date`=curdate()');
$user_password=$this->dbs->current->insert();
$this->dbs->current->query('insert into _user_uids set _user='.$user_id.',valid_from=curdate(),uid="Florian",date=curdate()');
$user_uid=$this->dbs->current->insert();
$this->dbs->current->query('insert into _user_activities set _user='.$user_id.',timestamp=now(),activity="email_create",value='.$user_email);
$this->dbs->current->query('insert into _user_activities set _user='.$user_id.',timestamp=now(),activity="email_activate",value='.$user_email);
$this->dbs->current->query('insert into _user_activities set _user='.$user_id.',timestamp=now(),activity="password_create",value='.$user_password);
$this->dbs->current->query('insert into _user_activities set _user='.$user_id.',timestamp=now(),activity="password_activate",value='.$user_password);
$this->dbs->current->query('insert into _user_activities set _user='.$user_id.',timestamp=now(),activity="uid_create",value='.$user_uid);
$this->dbs->current->query('insert into _user_activities set _user='.$user_id.',timestamp=now(),activity="uid_activate",value='.$user_uid);
	}
}
