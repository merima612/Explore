const AccommodationService = {
    getAllAccommodations: function() {
        return RestClient.get('accommodations');
    },
    
    getAccommodationById: function(id) {
        return RestClient.get(`accommodations/${id}`);
    },
    
    createAccommodation: function(accommodationData) {
        return RestClient.post('accommodations', accommodationData);
    },
    
    updateAccommodation: function(id, accommodationData) {
        return RestClient.put(`accommodations/${id}`, accommodationData);
    },
    
    deleteAccommodation: function(id) {
        return RestClient.delete(`accommodations/${id}`);
    },

    getAccommodationsByDestination: function(destinationId) {
        return RestClient.get(`accommodations/destination/${destinationId}`);
    }
};