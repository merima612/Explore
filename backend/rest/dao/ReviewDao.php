<?php
require_once __DIR__ . "/BaseDao.php";

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("review", "review_id");
    }

    public function create($data) {
        return $this->insert($data);
    }

    public function getAllReviews() {
        return $this->getAll();
    }

    public function getReviewById($id) {
        return $this->getById($id);
    }

    public function updateReview($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteReview($id) {
        return $this->delete($id);
    }
}
?>
