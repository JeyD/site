<?

require_once 'models/model.php';
require_once 'models/user_model.php';

class ObjCtrl{

	protected static $conn;
	protected static $used_db = 'oracle';

	function __construct(){

		$string = file_get_contents(BASEPATH."/config");
	}
}

?>
