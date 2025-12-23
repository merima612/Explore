const BookingService = {
    getAllBookings: function() {
        return RestClient.get('bookings');
    },
    
    createBooking: function(bookingData) {
        return RestClient.post('bookings', bookingData);
    },
    
    cancelBooking: function(id) {
        return RestClient.delete(`bookings/${id}`);
    },
    
    getUserBookings: function(userId) {
        return RestClient.get(`bookings/user/${userId}`);
    }
};