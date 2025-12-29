const DestinationService = {
    getAllDestinations: function() {
        return RestClient.get('destinations');
    },
    
    getDestinationById: function(id) {
        return RestClient.get(`destinations/${id}`);
    },

    createDestination: function(destinationData) {
        return RestClient.post('destinations', destinationData);
    },
 
    updateDestination: function(id, destinationData) {
        return RestClient.put(`destinations/${id}`, destinationData);
    },

    deleteDestination: function(id) {
        return RestClient.delete(`destinations/${id}`);
    },
    
    searchDestinations: function(searchParams) {
        return RestClient.get('destinations/search', searchParams);
    }
};