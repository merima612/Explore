<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/ReviewDao.php';

class ReviewService extends BaseService {
    public function __construct() {
        $dao = new ReviewDao();
        parent::__construct($dao);
    }

    
    public function getAllReviews() {
        return $this->dao->getAllReviews();
    }

    public function getReviewById($id) {
        return $this->dao->getReviewById($id);
    }
    public function createReview($data) {
        if ($data['rating'] < 1 || $data['rating'] > 5) {
            throw new Exception('Rating must be between 1 and 5.');
        }
        return $this->dao->create($data);
    }

    public function updateReview($id, $data) {
        return $this->dao->updateReview($id, $data);
    }

    public function deleteReview($id) {
        return $this->dao->deleteReview($id);
    }


}
?>
