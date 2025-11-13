<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/DestinationDao.php';

class DestinationService extends BaseService {
    public function __construct() {
        $dao = new DestinationDao();
        parent::__construct($dao);
    }

    public function getByRegion($region) {
        return $this->dao->getByRegion($region);
    }
}
?>
