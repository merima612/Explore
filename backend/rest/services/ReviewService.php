<?php
require_once __DIR__ . '/../dao/ReviewDao.php';

class ReviewService {
    private $reviewDao;

    public function __construct() {
        $this->reviewDao = new ReviewDao();
    }

    public function addReview($user_id, $destination_id, $rating, $comment) {
        return $this->reviewDao->createReview($user_id, $destination_id, $rating, $comment, date('Y-m-d'));
    }

    public function getDestinationReviews($destination_id) {
        return $this->reviewDao->getReviewsByDestination($destination_id);
    }
}
?>
