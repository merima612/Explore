var ReviewService = {

    getAllReviews: function() {
        return RestClient.get('reviews');
    },
    
    getReviewById: function(id) {
        return RestClient.get('reviews/' + id);
    },
    
    createReview: function(reviewData) {
        return RestClient.post('reviews', reviewData);
    },
  
    updateReview: function(id, reviewData) {
        return RestClient.put('reviews/' + id, reviewData);
    },

    deleteReview: function(id) {
        return RestClient.delete('reviews/' + id);
    },

    getReviewsByAccommodation: function(accommodationId) {
        return RestClient.get('reviews/accommodation/' + accommodationId);
    },

    getReviewsByDestination: function(destinationId) {
        return RestClient.get('reviews/destination/' + destinationId);
    },
 
    getReviewsByUser: function(userId) {
        return RestClient.get('reviews/user/' + userId);
    },

    getAverageRatingForAccommodation: function(accommodationId) {
        return RestClient.get('reviews/average/accommodation/' + accommodationId);
    },

    getAverageRatingForDestination: function(destinationId) {
        return RestClient.get('reviews/average/destination/' + destinationId);
    },

    validateReview: function(reviewData) {
        const errors = [];
        
        if (!reviewData.rating || reviewData.rating < 1 || reviewData.rating > 5) {
            errors.push('Rating must be between 1 and 5');
        }
        
        if (!reviewData.comment || reviewData.comment.trim().length < 10) {
            errors.push('Comment must be at least 10 characters long');
        }
        
        if (!reviewData.accommodation_id && !reviewData.destination_id) {
            errors.push('Review must be for either accommodation or destination');
        }
        
        return errors;
    },
    
    formatReviewDate: function(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    },

    renderReview: function(review) {
        const stars = '★'.repeat(review.rating) + '☆'.repeat(5 - review.rating);
        const date = this.formatReviewDate(review.created_at);
        
        return `
            <div class="review-card">
                <div class="review-header">
                    <h5>${review.user_name || 'Anonymous'}</h5>
                    <div class="rating">${stars}</div>
                    <small class="text-muted">${date}</small>
                </div>
                <div class="review-body">
                    <p>${review.comment}</p>
                </div>
                ${UserService.isAdmin() ? `
                    <div class="review-actions">
                        <button class="btn btn-sm btn-primary" onclick="ReviewService.editReview(${review.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="ReviewService.deleteReview(${review.id})">Delete</button>
                    </div>
                ` : ''}
            </div>
        `;
    }
};